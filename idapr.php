<pre id="pre"></pre>
<?php
function main (){
$file = 'i2.json';
if(!file_exists($file))
	die('no file');
$json = file_get_contents($file);
$json = mb_convert_encoding($json, mb_detect_encoding($json), 'UTF-8');
/*$Json= preg_replace('/^.*?(\{.+)$/','$1',$json);
$Json = preg_replace('/[[:cntrl:]]/', '', $Json);*/
$decode= json_decode($json,1);
if(is_array($decode))
	{
		$mass = $decode['data']['data'];
	usort($mass, function ($a,$b){
		$k1= ($a['comment']['num']['smiles']*1);
		$k2=($b['comment']['num']['smiles']*1);
			if($k1 ==$k2)
return false;
return $k1 < $k2?1:-1;
	//return > ($b['comment']['num']['smiles']*1)? 1:-1 ;
	});
	}
$json_last_error_msg=json_last_error_msg();
//var_dump(compact('mass'));

$petty =  json_encode(json_decode($json),JSON_PRETTY_PRINT,JSON_UNESCAPED_UNICODE);
file_put_contents('i2_formatted.json',$petty); 

}
main();

?>
<script>
function load(){
	debugger; 
pre= document.getElementById('pre');
pre.innerHTML='загрузка..';
fetch('/trash/i2_formatted.json')
.then(response => response.json())
. then(obj =>{
	debugger;
		pre.innerHTML=JSON.stringify(obj,null,' ');
		hljs.highlightBlock(pre);
			})
				.catch(function(error) {  
    log('Request failed', error)  
  });
function  ca ()
{
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
 lineNumbers: true,
 styleActiveLine: true,
 matchBrackets: true 
}); var input = document.getElementById("select");
}
}//load
try{
load();}catch(e){
alert(e['message']);

}
</script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/styles/default.min.css"> 
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/styles/idea.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/highlight.min.js"></script>
 <!-- and it's easy to individually load additional languages --> 
<script charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.4.1/languages/go.min.js"></script>
<script src="://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/codemirror.min.js"></script> <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.32.0/codemirror.min.css" />

