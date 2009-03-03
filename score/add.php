<?php
session_start();


function isNotDup($sc,$lv) {
  $query  = "SELECT COUNT(name) as c FROM `hscore` ";
  $query  .= "WHERE (`score` = '{$sc}') AND (`lvl` = '{$lv}')";
	
  include '/var/g2data/configDiS.phps';
  include '/var/g2data/opendb.phps';
  $result = mysql_query($query);
  $row = mysql_fetch_array($result, MYSQL_ASSOC);
  if ($row['c']=="0")
  {
	include '/var/g2data/closedb.phps';
	return true;
  }
  else
  {
	include '/var/g2data/closedb.phps';
	return false;
  }
}



function sanitize($s, $max)
{
	$s = preg_replace("/[^a-zA-Z0-9]/", "", $s);
  	$len = strlen($s);
	if ($len > $max)
		$s = substr($s, 0, $max);
	return $s;
}

$compScore = $_SESSION['turns'];

if ((isset($_POST['name']))&&(isset($_SESSION['turns']))&&(isset($_SESSION['lname']))) {
	$name 	= sanitize($_POST['name'], 		7);
	$sc 	= sanitize($compScore, 		8);
	$lv 	= sanitize($_SESSION['lname'], 	10);
	if (isNotDup($sc,$lv))
	{
		include '/var/g2data/configDiS.phps';
  		include '/var/g2data/opendb.phps';
		$query  = "INSERT INTO `DiS`.`hscore` (`id`, `name`, `score`, `lvl`) VALUES (NULL, '{$name}', '{$sc}', '{$lv}');";
		$result = mysql_query($query);
		include '/var/g2data/closedb.phps';
		header( 'Location: view.php' );
	}
	else 
	{
		
		header( 'Location: view.php' );
	}
	
}
?>

