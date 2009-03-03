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
		body table tr td .a1 {
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



$dimension = 2;/*4 for 4x4 or whatever*/;
if ($x > 2) 
{
$dimension = $x;

}
$numPermutations = pow(2, ($dimension * $dimension));

for ($permIndex = 0; $permIndex < $numPermutations; $permIndex++)
{
echo "<table id='tbl' cellpadding=0 cellspacing=0 style='float:left;margin:1px;'>";
	for ($x = 0; $x < $dimension; $x++)
	{
echo "<tr>";
		$offset = $x * $dimension;
		for ($y = 0; $y < $dimension; $y++)
		{
			$varvar = (1 << ($offset + $y) & $permIndex) ? 1 : 0;
			if ($varvar!=0)
			{
				$varvar = 1;
			}	
			echo "<td><div class='a{$varvar}'></div></td>";
			// Change arrayOfLevels to whatever name obviously
			//$arrayOfLevels[$permIndex][$x][$y] = ((1 << ($offset + $y) & $permIndex);
		}
echo "</tr>";
	}
	echo "</table>";
}

?>
	</body>
</html>