<?php 
$l = 1;
$h = 9;
$height = 15;
$width = 35;
$_SESSION['lname'] = "15x35Walled";
for ( $it1 = 0; $it1 <= $height; $it1 += 1) {
	for ( $it2 = 0; $it2  <= $width; $it2 += 1) {
		$board[$it1][$it2] = rand($l, $h);
	}
}
$board[rand(0, $height)][rand(0, $width)] = 0;
$board[rand(0, $height)][rand(0, $width)] = 0;
$board[rand(0, $height)][rand(0, $width)] = 0;
$board[0][$width/2] = 10;
$board[1][$width/2] = 10;
$board[2][$width/2] = 10;
$board[3][$width/2] = 10;
$board[4][$width/2] = 10;
$board[5][$width/2] = 10;
$board[6][$width/2] = 10;

?>