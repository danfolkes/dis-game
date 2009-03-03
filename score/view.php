<?php
include '/var/g2data/configDiS.phps';
include '/var/g2data/opendb.phps';
	
function sanitize($s, $max)
{
	$s = preg_replace("/[^a-zA-Z0-9]/", "", $s);
  	$len = strlen($s);
	if ($len > $max)
		$s = substr($s, 0, $max);
	return $s;
}
function sanNoMax($s)
{
	$s = preg_replace("/[^a-zA-Z0-9]/", "", $s);
  	return $s;
}
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

//get the levels
	$query  = "SELECT distinct lvl FROM `hscore` ";
	$result = mysql_query($query);
	while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$q2 = "SELECT name, score, ts FROM `hscore` WHERE(`lvl` = '{$row['lvl']}') ORDER BY score ASC LIMIT 10";
		$r2 = mysql_query($q2);
		echo "<table border=1 cellspacing=0 cellpadding=2 style='float:left;margin-left:10px; margin-top:10px;'><tr><th colspan='5' align='center' bgcolor='grey'>{$row['lvl']}</th></tr><tr><th width=100>Name</th><th width=100>Score</th><th>Moves</th><th width=150>Time</th><th width=150>Date</th></tr>";
		$rowcount = 0;
		while($row2 = mysql_fetch_array($r2, MYSQL_ASSOC)) {
			$rowcount +=1;
			echo "<tr>";
			echo "<td>".sanNoMax($row2['name'])."</td><td>";
			echo sanNoMax($row2['score'])."</td><td>";
			$scLen = strlen($row2['score']);
			echo substr($row2['score'], 0, $scLen-6)."</td><td>";
			echo strTime(substr($row2['score'], $scLen-6, $scLen-2));
			echo " ".substr($row2['score'], $scLen-2, $scLen).ms;
			echo "</td><td>";
			echo $row2['ts'];
			echo "</td>";
			echo "</tr>";
			
		}
		while ($rowcount < 10) 
		{
			$rowcount +=1;
			echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
			
		}
		echo "</table>";
	}
	include '/var/g2data/closedb.phps';

?>

