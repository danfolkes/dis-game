<html>
	<head>
	<link rel="stylesheet" href="../style.css" type="text/css" />
	<script>
	var color = 0;
	function setMainColor(val) {
		color = val;
		up = true;
	}
	var setC = function(a)  {
		if (!up) 
		{
			a.className = "a" + color;
		}
	}
	var up = true;
	function cSwitch(a){ 
		a.className = "a" + color;
		if (up)
		{
			up = false;
		}
		else
		{
			up = true;
		}
	}
	function saveit() {
		var out=document.getElementById("output");
		out.innerHTML = "\n " + "<&#63;php";
		out.innerHTML += "\n" + "// This  will have the random number go from 1 to 9.";
		out.innerHTML += "\n" + "//Please do not go under 1 or over 9";
		out.innerHTML += "\n" + "$l = 0; //this is which color the randomness starts on";
		out.innerHTML += "\n" + "$h = 2; //this is where it ends";
		out.innerHTML += "\n" + "//Board Settings";
		out.innerHTML += "\n" + "$height = 20;";
		out.innerHTML += "$width = 20;";
		out.innerHTML += "\n" + "//How many turns the user gets";
		out.innerHTML += "\n" + "$_SESSION['lname'] = \"Sedentary\";";
		out.innerHTML += "\n" + "//Building the board's array  and filling it with random numbers from $l to $h";
		out.innerHTML += "\n" + "$colors[0] = 1;";
		out.innerHTML += "\n" + "$colors[1] = 3;";
		out.innerHTML += "\n" + "$colors[2] = 9;";
		var x=document.getElementById('tbl');
		for (i=0;i<=x.rows.length-1;i++)
		{
			for (j=0;j<=x.rows[i].cells.length-1;j++)
			{
				
				if (!(i == 0)||(j == 0))
				{
					
					var strg = "" + x.rows[i].cells[j].innerHTML;
					v1 = strg.indexOf("class=\"a");
					v2 = strg.indexOf("\"",v1+8);
					v3 = strg.substring(v1+8,v2);
					disI = i-1;
					if (v3=="11")
					{
						disI = i-1;
						out.innerHTML = out.innerHTML + "$board["+disI+"]["+j+"]=$colors[rand($l, $h)];";
					}
					else 
					{
						out.innerHTML = out.innerHTML + "$board["+disI+"]["+j+"]=" + v3 + ";";
					}
				}
				else {
					alert(i+" "+j);
				}
				if ((j % 3 == 0)&&(j != 0))
				{
					out.innerHTML = out.innerHTML  + "\n";
				}
			}
		}
		out.innerHTML += "\n" + "";
		out.innerHTML += "\n" + "";
		out.innerHTML += "\n" + "";
		out.innerHTML += "\n" + "?>";
	}
	</script>
	<style>
		body table tr td a {
			border:1px black solid;
		}
		body table tr td a.ddd {
			color:red;
			background-color:red;
		}
		body table tr td a.c0 {
			background-color:red;
		}
		body table tr td a.c1 {
			background-color:blue;
		}
	</style>
	</head>
	<body>
<?php 
	$x = $_GET["x"];
	$y = $_GET["y"];
	$x1 = $x +1;
	echo "<table id='tbl' cellpadding=0 cellspacing=0>";
	for ( $i = 0; $i < $x; $i += 1) {
		echo "<tr>";
		for ( $j = 0; $j < $y; $j += 1) {
			if (($j==0) && ($i==0))
			{
				echo "<td rowspan='{$x}'>";
?>
				<table>
					<tr>
						<td><a class="a0" onClick="setMainColor(0)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a1" onClick="setMainColor(1)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
					<tr>
						<td><a class="a2" onClick="setMainColor(2)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a3" onClick="setMainColor(3)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
					<tr>
						<td><a class="a4" onClick="setMainColor(4)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a5" onClick="setMainColor(5)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
					<tr>
						<td><a class="a6" onClick="setMainColor(6)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a7" onClick="setMainColor(7)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
					<tr>
						<td><a class="a8" onClick="setMainColor(8)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a9" onClick="setMainColor(9)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
					<tr>
						<td><a class="a10" onClick="setMainColor(10)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
						<td><a class="a11" onClick="setMainColor(11)">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
					</tr>
				</table>
<?php
				echo "</td>";
			}
			else if ($j==0)
			{
				echo "";
			}
			else {
				echo "<td><a href='#' class='a0' onClick='cSwitch(this)' onMouseover='setC(this)'>&nbsp;&nbsp;&nbsp;&nbsp;</a></td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
?>
	
	<a href="#" onClick="saveit()">Save</a>
	<br/>
	<div ></div>
	<textarea id="output" rows='20' cols='150'></textarea>
	</body>
</html>