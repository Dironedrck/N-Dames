<?php

class NDames {

	public $n;
	public $firstPosition;
	public $dames;

	public function __construct($n = 8, $firstPosition=array('x'=>0, 'y'=>0)){

		$this->n = $n ;
		$this->firstPosition = $firstPosition;
		
		return $this;
	}

	public function run(){
		$this->dames[0] = $this->firstPosition;
		$this->push(1, $this->firstPosition['x'], $this->firstPosition['y']);
		return $this->dames;
	}

	public function push($index, $x, $y){
		if($index < $this->n){
			if($newPos = $this->nextValidPosition($x, $y)){
				$this->dames[$index] = $newPos;
				echo '<br />##'. $index .' => '. $newPos['x'].','.$newPos['y'] ;
				$this->push($index+1, $newPos['x']+1, 0);
			}else{
				echo '<br />OOOPS ['. $index .'] => ??'; 
				
				$index--;
				$currentX = $this->dames[$index]['x']; 
				$currentY = $this->dames[$index]['y'];
				//echo '<br />['. $index .'] Current X/Y => '. $currentX .' / '. $currentY;
				
				array_pop($this->dames);
				$this->push($index, $currentX, $currentY+1);
			}
		}
	}
	
	public function run2(){
		$this->push2(0, $this->firstPosition['x'], $this->firstPosition['y']);
		echo'<pre>'; print_r($this->dames); echo'</pre>';
		return $this->dames;
	}
	
	public function push2($index, $x, $y, $push = true){
		if($index < $this->n){
			
			
			$yy = $y+1;
			if($push){
				$yy = 0;
				$this->dames[$index] = array('x'=>$x, 'y'=>$y);
			}
			
			echo '<br />## '. $index .' >> '. $x.','.$y; // ' NEXT '. ($x+1) .','. $yy;
			
			if($newPos = $this->nextValidPosition($x+1, $yy)){
				//echo'<pre>'; print_r($newPos); echo'</pre>';
				$index++;
				$this->push2($index, $newPos['x'], $newPos['y']);
			}else{
				echo '<br />OOOPS ['. ($index+1) .'] => ??'; 
				
				$lastDame = end($this->dames);
				
				$currentX = $lastDame['x']; 
				$currentY = $lastDame['y'];
				echo '<br />['. $index .'] Current X/Y => '. $currentX .' / '. $currentY;
				
				//$index--;
				array_pop($this->dames);
				$this->push2($index, $currentX, $currentY+1, false);
			}
		}
	}

	public function nextValidPosition($minX, $minY){

		//echo '<br />nextValidPosition >> '. "$minX, $minY<br />";
		for($x=$minX ; $x < $this->n ; $x++){
			for($y=$minY ; $y < $this->n ; $y++){

				if($this->isValid($x, $y)){
					return array('x'=>$x, 'y'=>$y);
				}

			}
		}

	}

	public function isValid($x, $y){

		foreach ($this->dames as $key => $dame) {
			if($x == $dame['x'] || $y == $dame['y'] || ($x-$y) == ($dame['x']-$dame['y']) || ($x+$y) == ($dame['x']+$dame['y']) )
				return false;
		}

		return true ;
	}
}







