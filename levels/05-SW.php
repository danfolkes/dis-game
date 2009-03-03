<?php 
// This  will have the random number go from 1 to 9.
//Please do not go under 1 or over 9
$l = 0; //this is which color the randomness starts on
$h = 2; //this is where it ends

$colors[0] = 1;
$colors[1] = 3;
$colors[2] = 9;





//Board Settings
$height = 20;
$width = 40;

//How many turns the user gets
$_SESSION['lname'] = "SW";
$_SESSION['size'] = 12;
//Building the board's array  and filling it with random numbers from $l to $h
for ( $it1 = 0; $it1 <= $height; $it1 += 1) { //goes down the array
	for ( $it2 = 0; $it2  <= $width; $it2 += 1) { //goes right on the array
		//where the random number from   $l to $h is applied to the board's array
		$board[$it1][$it2] = $colors[rand($l, $h)];
	}
}

//Adding extra values to the board
//Adding starting points
$board[$height][0] = 0;
//Adding a wall randomly
//$board[rand(0, $height)][rand(0, $width)] = 10;
//$board[0][0] = 11;

//Adding a wall specifically
//$board[5][5] = 10;
?>