<pre>
<?php
//die(__LINE__);
$s=scandir($d=__DIR__);
$include=['php'];
$exclude=['.','..'];
$s=array_filter($s, function ($i) use($include,$exclude) {
	$ext=pathinfo($i);
	return !in_array($i, $exclude )&&in_array($ext['extension'], $include );
}
);
$rnd=array_rand($s);
echo json_encode(($s[$rnd]));

?>