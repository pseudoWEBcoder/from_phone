<?php
$arr=explode(' ','каждый охотник желает знать где сидит фазан' );

	$tr=[];
	$colors= [
	'к'=>'красный red',
	 'о'=>'оранжевый orange',
	'ж'=>'желтый yellow',
	'з'=>'зеленый green',
	'г'=>'голубой blue',
	'с'=>'синий darkblue',
	'ф'=>'фиолетовый purple'
	];
			shuffle($arr);
			rsort($arr);
		foreach($arr as $k=>$v){
		$color=explode(' ',$colors	[$s=mb_substr($v,0,1)]);
		
		$tr[0][]='<th style=" margin:1px;color:'.$color[1].'; border-color:'.$color[1].'">'.$v.'</th>';
			
			$tr[1][]='<td style="color:'.$color[1].'; border-color:'.$color[1].'">'.$color[0].'</td>';

};
echo '<div class="container"><table class="table table-bordered"><thead><tr>'.implode(PHP_EOL, $tr[0]).'</tr></thead><tbody><tr>'.implode(PHP_EOL, $tr[1]).'</tr></tbody></table></div>'
.'<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">';
	
function debug($arr){
	echo '<pre>';
var_dump($arr);
echo '</pre>';
}
?>