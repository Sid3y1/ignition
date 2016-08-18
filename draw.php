<?php



$dessin = Array( Array(10,20) , Array(1920,910),Array(810,13));
$dessin = Array( Array(0,0) , Array(1000,0000),Array(1000,1000),Array(000,1000),Array(0000,0000),Array(1000,1000));

if(!isset($argv[1]))
exit("missing filename");
$dessin = json_decode(file_get_contents($argv[1]),1);

$dessin = Array( Array(0,0) , Array(10,000),Array(10,10),Array(000,10),Array(0000,0000),Array(10,10));
$dessin = Array( Array(0,0) , Array(1000,0000),Array(1000,1000),Array(000,1000),Array(0000,0000),Array(1000,1000));

//$dessin = Array( Array(100,200) );
require('move.class.php');
$move = new Move();
$move->prepare($dessin[0][0],$dessin[0][1]);
foreach($dessin as $coord){
$move->go($coord[0] , $coord[1]);
}
