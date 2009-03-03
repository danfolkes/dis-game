<html>
	<head>
	<link rel="stylesheet" href="../style.css" type="text/css" />
		<style>
		body table tr td .a0 {
			border:none;
			display:block;
			height:10px;
			width:10px;
			background-color:black;

		}
		body table tr td .a10 {
			border:none;
			display:block;
			height:10px;
			width:10px;
			background-color:white;

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
			if (rand(0, 1)==1)
			{
				echo "<td><div href='#' class='a0'></div></td>";
			}
			else{
				echo "<td><div href='#' class='a10'></div></td>";
			}

		}
		echo "</tr>";
	}
	echo "</table>";
?>
	</body>
</html>