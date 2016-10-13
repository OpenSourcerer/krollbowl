<?php
require_once("Frame.php");
class Score{
	# Class Score takes an array of Frame objects and calculates the score.
	public $frames;
	public $score;
	function __construct(array $frames){
		$this->setFrames($frames);
		$this->setScore(0);
	}
	function setFrames($frames){
		$this->frames = $frames;
	}
	function getFrames(){
		return $this->frames;
	}
	function getScore(){
		return $this->score;
	}
	function setScore($score){
		$this->score = $score;
	}
	function incrementScore($add){
		# add is number to add to the score;
		$current = $this->getScore();
		$this->setScore($current + $add);
	}
	function calculate(){
		$frames = $this->getFrames();
		for($i = 0; $i <= 9; $i++){
			$f = $frames[$i];
			switch($f->value){
				case "X":
					$frame1 = $this->getNextFrame($i);
					$frame2 = $this->getNextFrame($i+1);
					$this->calculateStrike($frame1, $frame2);
					break;
				case "/":
					$this->calculateSpare($this->getNextFrame($i));
					break;
				default:
					$this->calculateScore($f);
					break;
			}
		}
		return $this->score;
	}
	function calculateStrike($frame1, $frame2){
		# frame are the next frame object
		$add = 10;
		if($frame1 != FALSE){
			$val1 = ($frame1->value == "X" || "/" ? 10 : $frame1->value);
			$add += $val1;
		}
		if($frame2 != FALSE){
			$val1 = ($frame2->value == "X" || "/" ? 10 : $frame2->value);
			$add += $val1;
		}
		$this->incrementScore($add);
	}
	function calculateSpare($frame){
		# calls next frame but only accesses first roll
		$val = ($frame->value == "X" ? 10 : $frame->rolls[0]);
		$add = 10 + $val;
		$this->incrementScore($add);
	}
	function calculateScore($frame){
		$this->incrementScore($frame->value);
	}
	# Utility Functions
	private function isGameOver($framekey){
		return $framekey >= count($this->getFrames())-1;
	}
	private function getNextFrame($current){
		# Takes Current Key
		if($this->isGameOver($current)){ #is the game over?
			return FALSE;
		}else{ #oh, it's not?  Here's the next frame.
			return $this->frames[$current+1];
		}
	}
}