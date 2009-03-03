<?php 
// This  will have the random number go from 1 to 9.
//Please do not go under 1 or over 9
$l = 1; //this is which color the randomness starts on
$h = 6; //this is where it ends

//Board Settings
$height = 20;
$width = 20;

//How many turns the user gets
$_SESSION['lname'] = "Pulsar";

//Building the board's array  and filling it with random numbers from $l to $h
for ( $it1 = 0; $it1 <= $height; $it1 += 1) { //goes down the array
	for ( $it2 = 0; $it2  <= $width; $it2 += 1) { //goes right on the array
		//where the random number from   $l to $h is applied to the board's array
		$board[$it1][$it2] = rand($l, $h);
	}
}

//Adding extra values to the board

//Adding a wall randomly
$board[8][8] = 10;
$board[8][9] = 10;
$board[8][11] = 10;
$board[8][12] = 10;
$board[12][8] = 10;
$board[12][9] = 10;
$board[12][11] = 10;
$board[12][12] = 10;
$board[9][8] = 10;
$board[11][8] = 10;
$board[9][12] = 10;
$board[11][12] = 10;

$board[8-2][8-2] = 10;
$board[8-2][9-2] = 10;
$board[8-2][11+2] = 10;
$board[8-2][12+2] = 10;
$board[12+2][8-2] = 10;
$board[12+2][9-2] = 10;
$board[12+2][11+2] = 10;
$board[12+2][12+2] = 10;
$board[9][8+2] = 10;
$board[11][8+2] = 10;
$board[9][12] = 10;
$board[11][12] = 10;

//Adding starting points
$board[$height/2][$width/2] = 0;

//$board[0][0] = 11;

//Adding a wall specifically
//$board[5][5] = 10;
?>