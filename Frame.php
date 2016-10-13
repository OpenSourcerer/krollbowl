<?php
class Frame{
	public $value;
	public $rolls;
	function __construct($rolls){
		$this->setRolls($rolls);
		$this->setValue();
	}
	function setRolls($rolls){
		$rolls = array_map(function ($v){ return $v == "-" ? 0 : $v;}, $rolls);  // Replace "-" (Gutter Balls) with 0.
		$this->rolls = $rolls;
	}
	function getRolls(){
		return $this->rolls;
	}
	function setValue(){
		$rolls = $this->getRolls();
		if(is_numeric($rolls[0]) && isset($rolls[1]) && is_numeric($rolls[1])){
			$this->value = array_sum($rolls);
		}elseif(!is_numeric($rolls[0]) && $rolls[0] != "X"){ # last frame spare
			$this->value = "/";
		}elseif(!is_numeric($rolls[0])){ # indicates strike
			$this->value = $rolls[0];
		}elseif(isset($rolls[1])){ # spare
			$this->value = $rolls[1];
		}
	}
}