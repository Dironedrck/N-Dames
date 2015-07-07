<?php

/**
 * N.Dames
 */

class NDames {

	public $n;
	public $firstPosition;
	public $dames;
	public $debug;

	public function __construct($n = 8, $firstPosition=array('x'=>0, 'y'=>4), $debug=true){

		$this->n = $n ;
		$this->firstPosition = $firstPosition;
		$this->debug = $debug;
		
		return $this;
	}
	
	/**
	 * >>>>>>>>>>>>>># SOLUTION 1
	 * Run algorithm 
	 */

	public function run(){
		$this->dames[0] = $this->firstPosition;
		if($this->debug) echo '<br />>> PUSH [0] => '. $this->firstPosition['x'].','.$this->firstPosition['y'] ;
		$this->push(1, $this->firstPosition['x'], $this->firstPosition['y']);
		return $this->dames;
	}

	public function push($index, $x, $y){
		static $currentX;
		static $currentY;
		if($index < $this->n){
			if($newPos = $this->nextValidPosition($x, $y)){
				$this->dames[$index] = $newPos;
				if($this->debug) echo '<br />>> PUSH ['. $index .'] => '. $newPos['x'].','.$newPos['y'] ;
				$this->push($index+1, $newPos['x']+1, 0);
			}else{
				if($this->debug) echo '<br />>> OOPS ['. $index .'] => ?,?'; 
				
				$index--;
				if($index >= 0){
					$currentX = $this->dames[$index]['x']; 
					$currentY = $this->dames[$index]['y'];
					//if($this->debug) echo '<br />['. $index .'] Current X/Y => '. $currentX .' / '. $currentY;
					
					array_pop($this->dames);
					$this->push($index, $currentX, $currentY+1);
				}else{
					$this->dames[$index+1] = array('x'=>$currentX, 'y'=>$currentY);
				}
			}
		}else{
			echo '<br />>> GOOD :)<br /><br />';
		}
	}
	
	// *************************************************************************** //
	
	/**
	 * >>>>>>>>>>>>>># SOLUTION 2
	 * Run algorithm 
	 */
	
	public function run2(){
		$this->push2(0, $this->firstPosition['x'], $this->firstPosition['y']);
		return $this->dames;
	}
	
	/**
	 * Push position
	 */
	public function push2($index, $x, $y, $push = true){
		if($index < $this->n){
			
			$yy = $y+1;
			if($push){
				$yy = 0;
				$this->dames[$index] = array('x'=>$x, 'y'=>$y);
			}
			
			if($this->debug) echo '<br />>> PUSH ['. $index .'] => '. $x.','.$y; // ' NEXT '. ($x+1) .','. $yy;
			
			if($newPos = $this->nextValidPosition($x+1, $yy)){
				//if($this->debug) echo'<pre>'; print_r($newPos); echo'</pre>';
				$index++;
				$this->push2($index, $newPos['x'], $newPos['y']);
			}else{
				if($this->debug) echo '<br />>> OOPS ['. ($index+1) .'] => ?,?'; 
				
				$lastDame = end($this->dames);
				
				$currentX = $lastDame['x']; 
				$currentY = $lastDame['y'];
				
				//$index--;
				array_pop($this->dames);
				$this->push2($index, $currentX, $currentY+1, false);
			}
		}
	}
	
	// *************************************************************************** //

	/**
	 * Get first next valid position from $minX, $minY
	 */
	public function nextValidPosition($minX, $minY){

		for($x=$minX ; $x < $this->n ; $x++){
			for($y=$minY ; $y < $this->n ; $y++){

				if($this->isValid($x, $y)){
					return array('x'=>$x, 'y'=>$y);
				}

			}
		}
	}
	
	/**
	 * Check position
	 */
	public function isValid($x, $y){

		foreach ($this->dames as $key => $dame) {
			if($x == $dame['x'] || $y == $dame['y'] || ($x-$y) == ($dame['x']-$dame['y']) || ($x+$y) == ($dame['x']+$dame['y']) )
				return false;
		}

		return true ;
	}
}

