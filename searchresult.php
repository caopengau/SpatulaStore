<!DOCTYPE html>
<html>
<head>
	<title>CaoPeng's DB ass3 part4</title>
	<style>
	table, th, td {
		border: 1px solid black;
	}
	</style>
</head>

<body>
<h1> Search Result: </h1>

<?php
	$con = mysqli_connect("info20003db.eng.unimelb.edu.au","pcao1","pcao1_2016","pcao1");
	if (mysqli_connect_errno()) {
		echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	}
	
	echo "<form method='POST' action='searchdetails.php' >";
	
	$sql_string = "SELECT * FROM Spatula";
	
	mysql_real_escape_string($con, $_POST['spatulaName']);
	$sql_string = $sql_string." WHERE ProductName LIKE '%".$_POST['spatulaName']."%'";
	
	if($_POST["Type"]!='-- select type --'){
		mysql_real_escape_string($con, $_POST['Type']);
		$sql_string = $sql_string." AND Type = '".$_POST['Type']."'";
	}
	if($_POST["size"]){
		mysql_real_escape_string($con, $_POST['size']);
		$sql_string = $sql_string." AND Size = '".$_POST['size']."'";
	}
	if($_POST["colour"]){
		mysql_real_escape_string($con, $_POST['colour']);
		$sql_string = $sql_string." AND Colour = '".$_POST['colour']."'";
	}
	if($_POST["price"]){
		mysql_real_escape_string($con, $_POST['price']);
		$sql_string = $sql_string." AND Price = ".$_POST['price'];
	}
	$sql_string = $sql_string.';';
	$result = mysqli_query($con, $sql_string);
	
	/* Only show name in the table */
	echo "<table style='width:10%'>";
	echo "<tr><th>Name</th></tr>";
	$i= 0;
	while($row = mysqli_fetch_array($result)) {
		echo "<tr>";
		echo "<td><a href='searchdetails.php?ProductName=".$row['ProductName']."'>".$row['ProductName']."</a></td>";
		echo "</tr>";
		$i += 1;
	}
	echo "</table><br>";
	echo "</form>";
	echo "<p><a href='orderform.php'>Sumbit an order</a><p>";
	mysqli_close($con);
?>
</body>
</html> 