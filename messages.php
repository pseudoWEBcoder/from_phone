<?php
//require 'idiorm.php';
require 'vendor/autoload.php';
$dir='';
?>
<?php
ob_start();
 ORM::configure($s= "sqlite:". __DIR__ ."/sqlite3.db");
function pre($s) {
	$db = debug_backtrace();
	echo '<pre>';
	var_dump($s);
	echo $db[0]['line'];
	echo '<hr>';
	echo '</pre>';
	die();
}
function delete ($id,&$arr) {
 		$mesage_list = ORM::for_table("messages")->where('parent_id', $id)->select(['id','message', 'parent_id'])->find_many();

		foreach($mesage_list as $i)
 {
			delete($i->id,$arr);
			$i->delete($i->id);
			$arr[]='#'.$i->id.$i->message;
		}
	}
 // This grabs the raw database connection from the ORM
 // class and creates the table if it does not already exist.
 // Would not normally be needed if the table is already there.
 $db = ORM::get_db();
 $db->exec("
 CREATE TABLE IF NOT EXISTS messages (
 id INTEGER PRIMARY KEY, 
 name TEXT, 
 message TEXT,
 created TEXT,
 data TEXT,
 parent_id INTEGER
 
 );"
 );

 // Handle POST submission
 if (!empty($_POST)) {
	// Create a new mesage object
 	$mesage = ORM::for_table("messages")->create();

 	// SHOULD BE MORE ERROR CHECKING HERE!

 	// Set the properties of the object
 	$mesage->name = $_POST["name"];
 	$mesage->message = $_POST["message"];
 	$mesage->created = time();
 	$mesage->data= gzencode(serialize($_SERVER));
 	$mesage->parent_id =$_POST["parent_id"]?$_POST["parent_id"]:0;
 	// Save the object to the database
 	$mesage->save();
 
 	// Redirect to self.
 	header("Location:". $dir. basename(__FILE__));
 	exit;
 }
 if (isset($_GET['load']) && isset($_GET['id'])) {
	delete ($_GET['id'],$a);
	$message=ORM::for_table('messages')->find_one($_GET['id']);
		$message->data=unserialize(gzdecode(	$message->data));
	pre(	$message->asArray());
	die();
	}
 if (isset($_GET['delete']) && isset($_GET['id'])) {
	delete ($_GET['id'],$a);
	ORM::for_table('messages')->find_one($_GET['id'])->delete ();
//	pre($a);
	

	//$person = ORM::for_table('messages') ->where_equal('parent_id', $_GET['id']) ->delete_many();
//	$person->delete();
	header("Location:". $dir. basename(__FILE__));
 	exit;
 	// 
}
 // Get a list of all mesages from the database
 $count = ORM::for_table("messages")->count();
 $mesage_list = ORM::for_table("messages")->where('parent_id',ORM::for_table('messages')->min('parent_id') )->find_many();

function messages ($list,$space=0) {
	$rn =PHP_EOL;
	$s= str_repeat(' ',$space);
	echo $s.'<ul cass="list-group">'.$rn;
	foreach( $list as $mesage ) {
		//$mesage->data=unserialize(gzdecode($mesage->data));
	unset($mesage->data);
		echo$s. ' <li class="list-group-item" data-mesage=\''.json_encode($mesage->as_array()).'\'>';
		//var_export($mesage->message);
		echo '<strong>'.$mesage->name .'</strong>'.$rn;
		echo $s. ' <div>'.$mesage->message .'</div>'.$rn;
 		$mesage_list = ORM::for_table("messages")->where('parent_id', $mesage->id)->find_many();
		if(count($mesage_list))
			messages($mesage_list,++$space);
		echo ' <a class="reply" href="#">ответить</a>'.$rn;
		echo ' <a href="?delete&id='.$mesage->id.'" class="text-danger delete">удалить</a>'.$rn;
		echo '<button type="button" data-toggle="modal" data-remote="?load&id='.$mesage->id.'" data-target="#myModel" class="btn btn-link btn-sm">...</button>'; 
;
		echo $s. ' </li>'.$rn;
	}
	echo $s.'</ul>'.$rn;

}
messages($mesage_list);
?>
		<!--
		<h1>messages:
		</h1>
		<h2>(
	<?php
	echo $count;
	 ?>
		messages)
	</h2>
	<ul>
<?php
foreach ($mesage_list as $mesage):?>
		<li>
			<strong>
		<?php
		echo $mesage->name ?>
			</strong>
				<span class="text-muted">
			<?=$mesage->created?date('d.m.Y h :i:s',$mesage->created):''?>
				</span>
				<div class="message">
			<?php
			echo $mesage->message;
			?>
				</div>
			</li>
		<?php
		endforeach;
		 ?>
			</ul>
			-->
			<div class="row">
				<div class="col-6">
					<form method="post" action="" id="f" class="form-">
			
						<input type="hidden" name="parent_id" value="0"/>
						<div class="form-group">
							<label for="name">Name:
							</label>
							<input type="text" name="name" class="form-control"  />
						</div>
						<div class="form-group">
							<label for="email">message:
							</label>
							<textarea name="message" class="form-control" ><?=(isset($_POST['message'])?$_POST['message']:'')?></textarea>
						</div>
						<div class="form-group">
							<input type="submit"  class="btn btn-success" value="написать" />
						</div>
					</form>
				</div>
			</div>
			<!-- Model --> <div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
			<div class="modal-dialog">
			 <div class="modal-content">
			 <div class="modal-header">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
			<span aria-hidden="true">&times;</span> </button> 
			<h3 class="modal-title" id="myModalLabel">Model Title</h3>
			 </div> <div class="modal-body"> <p> <img alt="loading" src="resources/img/ajax-loader.gif"> </p> 
			</div> 
			<div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary">Submit</button>
			 </div> 
			</div> 
			</div> 
			</div>
		<?php
		$content=ob_get_contents();
		ob_end_clean();
		?>
			<!doctype html>
				<html lang="en">
					<head>
						<!-- Required meta tags -->
							<meta charset="utf-8"> 
								<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
									<!-- Bootstrap CSS -->
										<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
											<title>Hello, world!
											</title>
										</head>
										<body class="container">
											<h1>messages
											</h>
										</h1>
									<?=$content?>
										<!-- Optional JavaScript -->
											<!-- jQuery first, then Popper.js, then Bootstrap JS -->
												<script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
													<script>
													jQuery (function (){
													$(document).on('click','.reply' ,function (event,el){
													debugger;
													var f = $('#f'), that = $(this), li=that.parent(),thisid=li.data('mesage').id;
													$('.reply-form').not('#f').empty();
													c= f.clone();
													console.log(li);
													c.attr('id', 'reply-form-to-'+ thisid);
													c.attr('class','reply-form');
													p=c.find('[name*=parent_id]');
													p.val(thisid);
													event.preventDefault();
													li.append(c);
													});
													$('body').on('click', '[data-toggle="modal"]', function(){ 
													$($(this).data("target")+' .modal-body').load($(this).data("remote")); 
													}); 
													
													});//ready
													</script>
																	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
																		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
																	</body>
																</html>