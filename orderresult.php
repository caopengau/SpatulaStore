<!DOCTYPE html>
<html>
<head>
	<title>CaoPeng's DB ass3 part2</title>
</head>

<body>

<?php
	$con = mysqli_connect("info20003db.eng.unimelb.edu.au","pcao1","pcao1_2016","pcao1");

	if (mysqli_connect_errno()) {
		echo "Could not connect to MySQL for the following reason: " . mysqli_connect_error();
	}

	$result = mysqli_query($con,"SELECT * FROM Spatula;");
	$enough = 1;	// indicator for sufficient stock, assumes sufficient initially
	$i = 0;
	mysqli_query($con,"START TRANSACTION;");	// START TRANSACTION
	while($row = mysqli_fetch_array($result)){
		// change in quantity of a spatula according to this order
		if ($_POST["q".$i]){
			mysql_real_escape_string($con, $_POST["q".$i]);
			$sql_string = "UPDATE Spatula SET QuantityInStock = QuantityInStock - ".$_POST["q".$i].
								" WHERE idSpatula = ".$row['idSpatula'].";";
			mysqli_query($con, $sql_string);
			if($row['QuantityInStock'] < $_POST['q'.$i]){	// Out of Stock
				$enough = 0; break;
			}
		}
		$i += 1;
	}

	$time = date('Y-m-d H:i:s');

	// insert into order table
	mysql_real_escape_string($con, $_POST['staff_name']);
	mysql_real_escape_string($con, $_POST['custDetails']);
	$sql_string = "INSERT INTO `Order` (RequestedTime, ResponsibleStaffMember, CustomerDetails) 
				VALUES ('".$time."', '".$_POST['staff_name']."', '".$_POST['custDetails']."');";
	mysqli_query($con, $sql_string);

	if($enough){	// COMMIT or ROLLBACK
		mysqli_query($con,"COMMIT;");
		echo "<h1>Thank You For Ordering!</h1>";
		echo "<p><a href='orderform.php'>Sumbit another order</a><p>";
		echo "<p><a href='search.php'>Search for other spatula</a><p>";
	}else{
		mysqli_query($con,"ROLLBACK;");
		echo "<h1>Sorry, out of stock!</h1>";
		echo "<p><a href='orderform.php'>Sumbit another order</a><p>";
		echo "<p><a href='search.php'>Search for other spatula</a><p>";
		exit();
	}

	// get the idorder from order table
	$sql_string = "SELECT idOrder FROM `Order` WHERE RequestedTime = '".$time."';";
	$result = mysqli_query($con, $sql_string);
	$row = mysqli_fetch_array($result);
	$idOrder = $row['idOrder'];

	// insert into OrderLineItem table
	$i = 0;
	$result = mysqli_query($con,"SELECT * FROM Spatula;");
	while($row = mysqli_fetch_array($result)){
		if(!$_POST['q'.$i]){	// skip zero quantity
			$i += 1; continue;
		}
		$sql_string = "INSERT INTO OrderLineItem VALUES (".$row['idSpatula'].", ".$idOrder.", ".$_POST['q'.$i].");";
		mysqli_query($con, $sql_string);
		$i += 1;
	}
	mysqli_close($con);
?>
</body>
</html>