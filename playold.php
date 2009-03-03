<?php
session_start();
$timesAllowed = 50;
$_SESSION['turns'] = $_SESSION['turns'] + 1;
if ((isset($_GET['j']))||($_GET['j']!=""))
	if (($_GET['j'] > 0)||($_GET['j'] < 10))
		$inpVal = $_GET['j'];
	else
		$inpVal = 999;
else
	$inpVal = 999;

if (isset($_GET["reset"])){
	unset($_SESSION['board']); 
	unset($_SESSION['turns']); 
	}

if (!isset($_SESSION['board'])) 
	initBoard();
else
	$board = $_SESSION['board'];
function initBoard() {
	
	if (isset($_GET["reset"])){
		if ($_GET["reset"] == "y")
		{
			include("levels/one.php"); 
		}
		else if ($_GET["reset"] == "one")
			include("levels/one.php"); 
		else if ($_GET["reset"] == "two")
			include("levels/two.php"); 
		else if ($_GET["reset"] == "three")
			include("levels/three.php"); 
		
	}
	else {
		include("levels/one.php"); 
	}
	$_SESSION['board']=$board;
}
function writeBoard()
{
	$board = $_SESSION['board'];
	foreach( $board as $key => $value){
		foreach( $board[$key] as $key2 => $value2){
			echo "<div class='box a$value2'></div>";
		}
		echo "<div style='clear:both;margin:0;padding:0;height:0px;line-height:0px;font-size:0px;'></div>";
	}
	echo "";
}
function changeIt($j)
{
	$retval = false;
	$board = $_SESSION['board'];
	foreach( $board as $key => $value){
		foreach( $board[$key] as $key2 => $value2){
			if ($value2 == 0)
			{
				$x = $key;
				$y = $key2;
				if ($board[$x+1][$y] == $j) {
					$retval = true;
					$board[$x+1][$y] = 0;
				}
				if ($board[$x-1][$y] == $j){
					$retval = true;
					$board[$x-1][$y] = 0;	
				}		
				if ($board[$x][$y+1] == $j){
					$retval = true;
					$board[$x][$y+1] = 0;
				}
				if ($board[$x][$y-1] == $j){
					$retval = true;
					$board[$x][$y-1] = 0;
				}
			}
		}
	}
	$_SESSION['board']=$board;
	return $retval;
}
function checkforcolors() {
	$retVal = 0;
	$board = $_SESSION['board'];
	foreach( $board as $key => $value){
		foreach( $board[$key] as $key2 => $value2){
			if (($value2 > 0)||($value2 < 10))
				$retVal += 1;
		
		}
	}	
	return $retVal;


}




?>

<?php
$changes = 0;
while(changeIt($inpVal)){$changes += 1;}
if ($changes == 0) {
	
	//check to see if all the squares are 0
	//if so, check count
		//if less, display WINNER and the difference

}


if ($_SESSION['turns'] >= $timesAllowed)
	echo "<script>alert('LOSER!');</script>";
?>
<body>
<div class="boarde" style="">
<?php writeBoard();?>
</div>
<head>
<style>
body {
	margin:1px;
	padding:0;

}
.boarde {
	
}
.box {
	width:13px;
	height:13px;
	float:left;
	margin:0;
	padding:0;
	line-height:1px;
	font-size:1px;
	border:1px black solid;
}
.bot {
	width:25px;
	height:25px;
	margin:1px;
}
.a1 {
	background-color:red;
}
.a2 {
	background-color:#FF00FF;
}
.a3 {
	background-color:blue;
}
.a4 {
	background-color:cyan;
}
.a5 {
	background-color:purple;
}
.a6 {
	background-color:#FFF000;
}
.a7 {
	background-color:brown;
}
.a8 {
	background-color:#BF7C00;
}
.a9 {
	background-color:lime;
}
.a0 {
	background:black;
	border:1px green solid;
}
.a10 {
	background:white;
	border:1px black solid;
}

</style>
</head>
</p style="">
	<a class="a1 box bot" href="play.php?j=1"></a>
	<a class="a2 box bot" href="play.php?j=2"></a>
	<a class="a3 box bot" href="play.php?j=3"></a>
	<a class="a4 box bot" href="play.php?j=4"></a>
	<a class="a5 box bot" href="play.php?j=5"></a>
	<a class="a6 box bot" href="play.php?j=6"></a>
	<a class="a7 box bot" href="play.php?j=7"></a>
	<a class="a8 box bot" href="play.php?j=8"></a>
	<a class="a9 box bot" href="play.php?j=9"></a>
</p>
<div style="clear:both" />	
<p>Directions: Start with the black square and try to fill the board with black.</p>
<p>Winning is not actually programmed yet.  Losing, works half the time.</p>



<br/>Turns:
<?php echo $_SESSION['turns'] ?>
 . Try to beat in less than <?php echo $timesAllowed; ?>.
 <br/>
<a href="play.php?reset=y">reset</a> | <a href="play.php?reset=two">level2</a> | <a href="play.php?reset=three">level3</a>
</p>
<h2>Flood-It - In PHP</h2>
<p>by Daniel Folkes</p>

</body>