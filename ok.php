<?php
$file='./line.txt';
if(!file_exists($file))
	die('no file');
$content=file(realpath($file));
foreach($content as $i=>$v)
if($i%2==0)
	$arr[$i]=htmlspecialchars($v);
var_dump([$content, $arr]);
echo 'ok';
?>