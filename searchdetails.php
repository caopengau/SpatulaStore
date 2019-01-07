<!DOCTYPE html>
<html>
<head>
	<title>CaoPeng's DB ass3 part5</title>
	<style>
	table, th, td {
		border: 1px solid black;
	}
	</style>
</head>

<body>
<h1> Details </h1>

<?php
	$con = mysqli_connect("info20003db.eng.unimelb.edu.au","pcao1","pcao1_2016","pcao1");
	if (mysqli_connect_errno()) {
		echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	}
	$sql_string = "SELECT * FROM Spatula";
	mysql_real_escape_string($con, $_GET['ProductName']);
	
	$sql_string = $sql_string." WHERE ProductName = '".$_GET['ProductName']."';";
	$result = mysqli_query($con, $sql_string);

	/* table heading output to the html */
	echo "<table style='width:50%'>";
	echo "<tr><th>Spatula ID</th>";
	echo "<th>Name</th>";
	echo "<th>Type</th>";
	echo "<th>Size</th>";
	echo "<th>Colour</th>";
	echo "<th>Price</th>";
	echo "<th>Quantity Currently in stock</th></tr>";
	
	$i= 0;
	$row = mysqli_fetch_array($result);
	/* data from DB into table form */
	echo "<tr>";
	echo "<td>". $row['idSpatula']."</td>";
	echo "<td>".$row['ProductName']."</td>";
	echo "<td>". $row['Type']."</td>";
	echo "<td>". $row['Size']."</td>";
	echo "<td>". $row['Colour']."</td>";
	echo "<td>". $row['Price']."</td>";
	echo "<td>". $row['QuantityInStock']."</td>";
	echo "</tr>";
	echo "</table><br>";
	echo "<p><a href='orderform.php'>Sumbit an order</a><p>";
	mysqli_close($con);
?>
</body>
</html> 