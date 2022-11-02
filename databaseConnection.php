<?php
	//include "tempVariables.php";
	include("Connect.php");
	

    $username = "TestUser2";


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
