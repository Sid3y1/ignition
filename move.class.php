<?php

require 'vendor/vendor/autoload.php';

use PhpGpio\Gpio;
class Move{

	public $debug=true;
	public $x=0;
	public $y=0;


	private $gpio_h = Array(16,12,20,21);
	private $gpio_v = Array(17,18,27,22);
	private $gpio;

	private $seq = Array(
			Array(1,0,0,1),
			Array(1,0,0,0),
			Array(1,1,0,0),
			Array(0,1,0,0),
			Array(0,1,1,0),
			Array(0,0,1,0),
			Array(0,0,1,1),
			Array(0,0,0,1)
			);
	public $state = 0;
	public function __construct(){

		$this->x = file_get_contents('x.txt');
		$this->y = file_get_contents('y.txt');
		//use PhpGpio\Gpio;
		$this->x = 0;
		$this->y = 0;

		$this->gpio = new GPIO();
		foreach(array_merge($this->gpio_h,$this->gpio_v) as $g){
			$this->gpio->setup($g,"out");
		}
		//usleep(1);
	}

	private function mstep($g,$s){
$s = $s + 1000000;
		foreach($g as $i => $p){
			$this->gpio->output($p,$this->seq[$s%8][$i]);
			echo "========= $p $s $i | ".$this->seq[$s%8][$i]." \n";
		}
usleep(10000);

	}


	public function clear(){
		echo "CLEARING\n";
	}



	public function prepare($x,$y){
		//TODO:REMETRE
		//$this->go($x,$y);
		$this->clear();
	}

	public function mx($n){
echo "X:".$this->x."\n";
		$this->x += $n;
		$this->mstep($this->gpio_h,$this->x);
		//file_put_contents('x.txt',$this->x);
		//echo "x:".$n ."\t abs=".$this->x ."\n";
	}

	public function my($n){
echo "Y:".$this->y."\n";
		$this->y += $n;
		$this->mstep($this->gpio_v,$this->y);
		//file_put_contents('y.txt',$this->y);
		//echo "y:".$n ."\t abs=".$this->y ."\n";
	}

	public function go($x,$y){

		$dx = $x-$this->x ;
		$dy = $y-$this->y;
		$dmax  = max(abs($dy),abs($dx));
		if($this->debug)
			echo "DMAX $dmax DX $dx DY $dy \n";
		for($i=0;$i<$dmax;$i++){
			if($dx != 0)
				$this->mx(round($i/($dmax/$dx))- round(($i-1)/($dmax/$dx) )); 
			if($dy != 0)
				$this->my(round($i/($dmax/$dy))- round(($i-1)/($dmax/$dy) )); 
			//$this->my(round($i/($dmax/$dy))); 

		}
	}
}

?>
