<?php
require_once("Frame.php");
if(isset($argv[1])){
	$rolls = str_split($argv[1]);
}elseif($_GET['rolls']){
	$rolls = str_split($_GET['rolls']);
}
$count = count($rolls);
$frames = array(");
for($i = 0; $i <= $count-1; $i++){
	$first = $rolls[$i];
	if($first == "X"){
		array_push($frames, new Frame(array("$rolls[$i])));
	}else{
		if(isset($rolls[$i+1])){ // Account for Final Spare
			array_push($frames, new Frame(array("$rolls[$i], $rolls[++$i])));		
		}else{
			array_push($frames, new Frame(array("$rolls[$i])));
		}
	}
}
require_once("Score.php");
$score = new Score($frames);
echo $score->calculate();
?>