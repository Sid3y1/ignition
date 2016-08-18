<?php


echo "OK";

$coord=$_POST['xy'];
//$coord=json_decode(file_get_contents($argv[1]));
//$coord = Array( Array(0,0) , Array(1000,0000),Array(1000,1000),Array(000,1000),Array(0000,0000),Array(1000,1000));
$coord = Array( Array(0,0) , Array(5000,0000),Array(0000,5000),Array(5000,5000),Array(2500,7500),Array(000,5000),Array(0,0),Array(5000,5000),Array(5000,0));

$oldx=0;
$oldy=0;
$mult = 10 ; //Coef multiplication


$minx = 999999999999999;
$maxx = 0;
$miny = 999999999999999;
$maxy = 0;

foreach($coord as $m){
$draw[]=Array($m[0],(350-$m[1]));
$minx = min($m[0],$minx);
$maxx = max($m[0],$maxx);
$miny = min((350-$m[1]),$miny);
$maxy = max((350-$m[1]),$maxy);
}

$size=10000;
$factor = $size / max(($maxx-$minx),($maxy-$miny)) ;
foreach($draw as $i=> $co){
$draw[$i][0] = round(($draw[$i][0] - $minx ) *$factor);
$draw[$i][1] = round(($draw[$i][1] - $miny ) *$factor);
}

file_put_contents('coord.txt',print_r($draw,1));
$coord=$draw;

//DEBUG
//$coord = Array( Array(0,0) , Array(1000,0000),Array(1000,1000),Array(000,1000),Array(0000,0000),Array(1000,1000));
$coord = Array( Array(0,0) , Array(5000,0000),Array(0000,5000),Array(5000,5000),Array(2500,7500),Array(000,5000),Array(0,0),Array(5000,5000),Array(5000,0));

$txt = "";
foreach($coord as $i => $go){

	$mx = $go[0] - $oldx;
	$my = $go[1] - $oldy;

	if( abs($mx) > abs($my)){
		$vx = 10;
if($my != 0){
		$vy = round(10 * abs($mx) / abs($my));
}

	}else{
if($mx!=0){
		$vx = round(10* abs($my) / abs($mx));
	}
	$vy = 10;

	}

if($mx!=0)
	$txt .= 'python stepperX.py '.$vx.' '.abs($mx).' '.($mx/abs($mx)).' &'."\n";
if($my!=0)
	$txt .= 'python stepperY.py '.$vy.' '.abs($my).' '.($my/abs($my)).' &'."\n";
	$txt .= 'wait'."\n";
if($i==0){
$txt .= 'read -n1 -r -p "Press space to continue..." key'."\n";
}
$oldx = $go[0];
$oldy = $go[1];
	/*
#wait / pixel / directio
python stepperY.py 1 10000 -1 &
python stepperX.py 1 000 1 &
wait
	 */






}
echo $txt;
file_put_contents('runIt.sh',$txt);

?>
