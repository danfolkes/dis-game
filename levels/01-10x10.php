<?php 
// This  will have the random number go from 1 to 9.
//Please do not go under 1 or over 9
$l = 1; //this is which color the randomness starts on
$h = 9; //this is where it ends

//Board Settings
$height = 10;
$width = 10;

//How many turns the user gets
$_SESSION['lname'] = "10x10";

//Building the board's array  and filling it with random numbers from $l to $h
for ( $it1 = 0; $it1 <= $height; $it1 += 1) { //goes down the array
	for ( $it2 = 0; $it2  <= $width; $it2 += 1) { //goes right on the array
		//where the random number from   $l to $h is applied to the board's array
		$board[$it1][$it2] = rand($l, $h);
	}
}

//Adding extra values to the board
//Adding starting points
$board[rand(0, $height)][rand(0, $width)] = 0;
$board[rand(0, $height)][rand(0, $width)] = 0;
$board[rand(0, $height)][rand(0, $width)] = 0;
//Adding a wall randomly
$board[rand(0, $height)][rand(0, $width)] = 10;

//Adding a wall specifically
//$board[5][5] = 10;
?>