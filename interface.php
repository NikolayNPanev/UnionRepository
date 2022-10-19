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

	if (str_contains($iban, "BOKB")) $bankName = "Bank of Kolyo";
	if (str_contains($iban, "BOVB")) $bankName = "Bank of Veni";

	echo "<h1> Welcome to the bank of $bankName";

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