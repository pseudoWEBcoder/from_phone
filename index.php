
<?php
$array1 = ["a" => "green", "pink", "blue", "red", "brown", "r" => "red", "red"];
$array2 = ["b" => "green", "brown", "black", "yellow", "pink",];
$result = array_keys(array_diff($array1, $array2));
$s=(int)'123foo';
echo '<pre>';
print_r($result);

die('<hr>');
//require_once './htmlpurifier-4.12.0-lite/HTMLPurifier.auto.php';
$str='<form action method="post"><table class="table table-bordered">';
$str.='<tr><td colspan=2>';
$action = get('action');
var_dump($action);
$str.=1111111;
$str.='</td></tr>';
$str.='<tr><td>';

$str.=govnocode('action', get('action') ,'radio','minus','-');
$str.='<td rowspan=2>';
$str.=govnocode('send','save' ,'submit','','');

$str.='</td></tr>';
$str.='<tr><td>';
$str.=govnocode('action', get('action') ,'radio','plus','+');
$str.='</td></tr>';
$str.='<form>';
 render($str);

function get ($key,$arr= 'request',$default=null){
	$arr=$arr== 'request'? $_REQUEST:$arr;
return isset($arr[$key])?$arr[$key]: $default;
}
function govnocode($name='',$value='',$type='',$id='',$label=''){
	
	$str='<label for"'.$id.'"><input type="'.$type.'" name="'.$name.'" value="'.$value.'" id="'.$id.'"> '.$label.'</label>';
return $str;
}

function render($body,$title='')
{
	
$str= '<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>'.$title.'</h1>
'.$body.'
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>';
$config = HTMLPurifier_Config::createDefault();
        $config->set('Attr.AllowedClasses',array('header')); // или Attr.ForbiddenClasses имеются ввиду CSS классы
        $config->set('AutoFormat.AutoParagraph',true); // авто добавление <p> в тексте при переносе
        $config->set('AutoFormat.RemoveEmpty',true); // удаляет пустые теги, есть исключения*
        $config->set('HTML.Doctype','HTML 4.01 Strict'); // обратите внимание как заменился тег <strike>
        $purifier = new HTMLPurifier($config);
        $clean_html = $purifier->purify($html);


}
?>