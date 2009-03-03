<?php
session_start();
$_SESSION['turns'] = $_SESSION['turns'] + 1;
if ((isset($_GET['j']))||($_GET['j']!=""))
	if (($_GET['j'] > 0)||($_GET['j'] < 10))
		$inpVal = $_GET['j'];
	else
		$inpVal = 999;
else
	$inpVal = 999;

if ((isset($_GET["reset"]))&&($_GET["reset"]!="nolevsel")){
	unset($_SESSION['board']); 
	unset($_SESSION['turns']); 
	}

if (isset($_GET["size"])){
	$sz = $_GET["size"];
	if (($sz=="2")||($sz=="5")||($sz=="10")||($sz=="15")||($sz=="20")||($sz=="35")||($sz=="55"))
		$_SESSION['size'] = $sz;
	
}
if (!isset($_SESSION['board'])) 
	initBoard();
else
	$board = $_SESSION['board'];



function initBoard() {
	$_SESSION['winnerflag']=false;
	$today = gettimeofday();
	$_SESSION['start'] = $today;
	
	if (isset($_GET["reset"])){
		if ($_GET["reset"] == "y")
		{
			include("levels/01-10x10.php"); 
		}
		$found = false;
		if ($handle = opendir('./levels/')) {
    			while (false !== ($file = readdir($handle))) {
        			if ($file != "." && $file != "..") {
            				$page_name=substr($file, 0, strpos($file, "."));
					if ($_GET["reset"]==$page_name) {
            					include("levels/{$page_name}.php");
						$found = true;
					}
        			}
    			}
		}
		if (!$found) include("levels/01-10x10.php");
		closedir($handle); 

	}
	else {
		include("levels/01-10x10.php"); 
	}
	$_SESSION['board']=$board;
}
function getExpScore($times) {
	if (isset($times))
		return pow(2,$times);
	else return 0;
}
function writeBoard()
{
	$board = $_SESSION['board'];
	echo "<table cellspacing=0 cellpadding=0>";
	foreach( $board as $key => $value){
		echo "<tr>";
		foreach( $board[$key] as $key2 => $value2){
			echo "<td>";
			if (($value2=="0")||($value2=="10"))
				echo "<a href='#' class='a$value2 box'></a>";
			else
				echo "<a href='play.php?j=$value2' class='a$value2 box'></a>";
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "<table>";
	echo "";
}
function writeBoardNoTable()
{
	$board = $_SESSION['board'];
	foreach( $board as $key => $value){
		foreach( $board[$key] as $key2 => $value2){
			if (($value2=="0")||($value2=="10"))
				echo "<a href='#' class='a$value2 box'></a>";
			else
				echo "<a href='play.php?j=$value2' class='a$value2 box'></a>";
				
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
				$x1 = $board[$x+1][$y];
				$xm = $board[$x-1][$y];
				$y1 = $board[$x][$y+1];
				$xm = $board[$x][$y-1];
				
				if ($x1 == $j) {
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
			if (($value2 > 0)&&($value2 < 10))
				$retVal += 1;
		}
	}	
	return $retVal;
}
?>

<head>
  <link rel="stylesheet" href="style.css" type="text/css" />


<?php
$changes = 0;
while(changeIt($inpVal)){$changes += 1;}

$lefter = checkforcolors();
//if ($_SESSION['turns'] >= $timesAllowed)
//	echo "<style>body {background: black url(images/loser.jpg);}</style>";

//else ->
if (!checkforcolors()){
	$_SESSION['turns'] -= 1;
	$win = true;
}

if (isset($_SESSION['size'])) {
	echo "<style>.box {height:{$_SESSION['size']};width:{$_SESSION['size']};}</style>";
}
?>
</head>
<body>
<div id="top"><form>
DiS - Darkness Is Spreading | <select name="reset" ><option value="nolevsel">--Level--</option>
<?php 
if ($handle = opendir('./levels/')) {
  while ($file = readdir($handle)) {
    $files[] = $file; 
  }
  closedir($handle);
}
sort($files);
reset($files);
$tmpCnt = 0;
foreach ($files as $k => $file) { 
  if ($file != "." && $file != "..") { 
	$page_name=substr($file, 0, strpos($file, "."));
	if ($tmpCnt==0)
	{
		echo " <option selected='true'>$page_name</option>";
		$tmpCnt+=1;
	}
	else 
	{
		echo " <option>$page_name</option>";
	}	
  }
}

?>
</select>
<select name="size">
  Size:
  <option>--Zoom--</option>
  <option value="2" >25%</option>
  <option value="5">50%</option>
  <option value="10">75%</option>
  <option value="15">100%</option>
  <option value="20">110%</option>
  <option value="35">150%</option>
  <option value="55">200%</option>
</select><input type="submit" value="Create"/> <a href="makelevel.html">make your own</a> |  In PHP by Daniel Folkes | <a href="./score/view.php">Score Board</a> 
</form>
</div>
<div class="boarde">
  <?php writeBoard();?>
</div>
<p>Directions: Start with the black square(s) and try to fill the board with darkness. Keep your score as low as possible!</p>
<?php 

function strTime($s) {
  $d = intval($s/86400);
  $s -= $d*86400;

  $h = intval($s/3600);
  $s -= $h*3600;

  $m = intval($s/60);
  $s -= $m*60;

  if ($d) $str = $d . 'd ';
  if ($h) $str .= $h . 'h ';
  if ($m) $str .= $m . 'm ';
  if ($s) $str .= $s . 's';

  return $str;
}


$a1 = $_SESSION['start'][sec];
$a2 = $_SESSION['start'][usec];
$a = $a1.substr($a2, 0, 2);
$today = gettimeofday();
$b1 = $today[sec];
$b2 = $today[usec];
$b = (int)$b1.substr($b2, 0, 2);
echo "<br/>Moves+Time=Score : {$_SESSION['turns']}";
$sec = $b-$a;
$compScore=$_SESSION['turns'].str_pad($sec, 6, "0", STR_PAD_LEFT);
echo "+".strTime(substr(str_pad($sec, 6, "0", STR_PAD_LEFT), 0, 4));
echo "=".$compScore;
 if (($win)&&(!$_SESSION['winnerflag'])) {

$_SESSION['turns']=$compScore;
?>
<br/>
<?php print_r($_COOKIE); ?>
<form action="score/add.php" name="highscore" method="post">
<input type="text" name="name" />
<input type="submit" value="add score" />
</form>
<?php 
	$_SESSION['winnerflag'] = true;
 }
?>

<script src="./javascript.js" LANGUAGE="JavaScript" ></script>
</body>