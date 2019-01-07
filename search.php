<!DOCTYPE html>
<html>
<head>
	<title>CaoPeng's DB ass3 part3</title>
</head>

<body>
<h1> Browse </h1>

<?php
	$con = mysqli_connect("info20003db.eng.unimelb.edu.au","pcao1","pcao1_2016","pcao1");
	if (mysqli_connect_errno()) {
		echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	}

	echo "<form method='POST' action='searchresult.php' >";
	
	/* textbox for spatulaName */
	echo "<p>Leave blank if you are not sure to increase your chance of finding results</p>";
	echo "<p>Spatula name: <input type='text' name = 'spatulaName' /></p>";
	
	/* dropbox for Type */
	$result = mysqli_query($con,"SELECT DISTINCT `Type` FROM Spatula;");
	echo "<select name='Type'>";
	echo "<option name = 'default' selected = 'selected'>-- select type --</option>";
	while($row = mysqli_fetch_array($result)) {
		echo "<option value='" . $row['Type'] . "'>";
		echo $row['Type'];
		echo "</option>";
	}
	echo "</select><br>";
	
	/* textbox for Size */
	echo "<p>Size: <input type = 'text' name = 'size' /></p>";
	
	/* textbox for Colour */
	echo "<p>Colour: <input type = 'text' name = 'colour' /></p>";
	
	/* textbox for Price */
	echo "<p>Price(\$AU): <input type = 'text' name = 'price' /></p>";

	/* bottuon for search */
	echo "<input type='submit' value='Search...' />";
	echo "</form>";
	echo "<p><a href='orderform.php'>Sumbit an order</a><p>";
	mysqli_close($con);
?>
</body>
</html> 