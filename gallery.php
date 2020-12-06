<?php
$dir ='..';
if(!$realpath=realpath($dir))
	die('папки'.$dir.' не существует');
$files =scandir($realpath);
foreach($files as $file) {
	$path=$realpath.'/' .$file;
	if(is_file($path)) {;
		$info['filesize']=filesize($path);
		$info['fileatime']=fileatime($path);
		$detail[] = array_merge(pathinfo($path),$info);
	}
}
function d ($str)
{
echo '<pre>';
var_dump($str);
echo '<pre>';
//die();
}
echo '<pre>';
var_dump($detail);
?>