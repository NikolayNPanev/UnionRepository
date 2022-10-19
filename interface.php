<!DOCTYPE html>
<html>
<body>

<?php 
	$dbservername = "remotemysql.com";
	$dbsername = "TCiMM7Lbhd";
	$dbpassword = "wEkolG5lDE";
	$database = "TCiMM7Lbhd";
	//$dbname="BankOfKolyo";
	$conn = new mysqli($dbservername, $dbsername, $dbpassword,$database);

	try {	$sql = new PDO("mysql:host=$dbservername;dbname=$database", $dbsername, $dbpassword);
	// set the PDO error mode to exception
	$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
	} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	}

	$username = "TestUser2";

	$sql = "SELECT IBAN FROM Credentials WHERE Username='$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$iban = $row["IBAN"];

	if (str_contains($iban, "BOKB")) {
		$bankName = "Bank of Kolyo";
		$bankdbName = "BankOfKolyo";
	}
	if (str_contains($iban, "BOVB")) {
		$bankName = "Bank of Veni";
		$bankdbName = "BankOfVeni";
	}

	$sql = "SELECT FirstName, LastName, Balance FROM $bankdbName WHERE IBAN='$iban'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$firstName = $row['FirstName'];
	$lastName = $row['LastName'];
	$balance = $row['Balance'];

	echo "<h1> Welcome to the bank of $bankName, $firstName $lastName </h1>";

	echo "<p> You currently have ". $balance . "lv.</p>";

	// $sql = "INSERT INTO Credentials (Username, Password, IBAN) VALUES ('TestUser2','123456','BG01BOVB');";

	// if(mysqli_query($conn, $sql)){
	// echo "Records inserted successfully.";
	// } else{
	// echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	// }

	// Close connection


	mysqli_close($conn);


?>
 </body>	
 </html>