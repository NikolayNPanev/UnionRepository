<?php
	//include "tempVariables.php";

	$dbservername = "sql11.freemysqlhosting.net";
    $dbusername = "sql11524679";
    $dbpassword = "VdUtWRxRUf";
    $database = "sql11524679";

    $username = "TestUser2";

    $conn = new mysqli($dbservername, $dbusername, $dbpassword,$database);

	try {	$sql = new PDO("mysql:host=$dbservername;dbname=$database", $dbusername, $dbpassword);
	// set the PDO error mode to exception
	$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
	} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	}

	

	$sql = "SELECT IBAN FROM Credentials WHERE Username='$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$iban = $row["IBAN"];

	if (strpos($iban, "BOKB") !== false) { $bankName = "Bank of Kolyo"; $bankNameSql = "BankOfKolyo"; }
    if (strpos($iban, "BOVB") !== false) { $bankName = "Bank of Veni"; $bankNameSql = "BankOfVeni"; }

    $sql = "SELECT * FROM $bankNameSql WHERE IBAN='$iban'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $bal = $row["Balance"];
    $currency = "lv.";