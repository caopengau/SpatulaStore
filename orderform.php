<!DOCTYPE html>
<html>
<head>
	<title>CaoPeng's DB ass3 part1</title>
	<style>
	table, th, td {
		border: 1px solid black;
	}
	</style>
</head>

<body>
<h1>Orders</h1>
<p>Customer Details:</p>

<?php
	
	$con = mysqli_connect("info20003db.eng.unimelb.edu.au","pcao1","pcao1_2016","pcao1");
	if (mysqli_connect_errno()) {
		echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	}

	echo "<form method='POST' action='orderresult.php' >";
	
	/* text area for customer detail */
	echo "<textarea id='custDetails' name='custDetails' style='width:50%; height: 70px;' maxlength='100'></textarea><br /><br />";
	
	/* textbox for staff info */
	echo "<p>Responsible Staff Member: <input type='text' name='staff_name'></p>";
	
	/* product info in table format */
	echo "<table style='width:50%'>";
	/* table heading */
	echo "<tr><th>Spatula ID</th>";
	echo "<th>Name</th>";
	echo "<th>Type</th>";
	echo "<th>Size</th>";
	echo "<th>Colour</th>";
	echo "<th>Price</th>";
	echo "<th>Quantity Currently in stock</th>";
	echo "<th>Order Quantity</th></tr>";
	$result = mysqli_query($con,"SELECT * FROM Spatula;");
	$i= 0;
	while($row = mysqli_fetch_array($result)) {	/* table data from DB*/
		echo "<tr><td>". $row['idSpatula']."</td>";
		echo "<td>".$row['ProductName']."</td>";
		echo "<td>". $row['Type']."</td>";
		echo "<td>". $row['Size']."</td>";
		echo "<td>". $row['Colour']."</td>";
		echo "<td>". $row['Price']."</td>";
		echo "<td>". $row['QuantityInStock']."</td>";
		echo "<td><input type='text' name = 'q".$i."'/></td></tr>";
		$i += 1;
	}
	echo "</table><br>";
	
	/* submit button */
	echo "<input type='submit' value='Submit' />";
	echo "</form>";
	mysqli_close($con);
?>
</body>
</html> 