<?php
	//include "tempVariables.php";
	include("Connect.php");
	
	$url= $_SERVER['REQUEST_URI'];    
	$pos = strpos($url, "username=") + 9;
	

    	$Username = substr($url, $pos);

	$sql = "SELECT IBAN FROM Credentials WHERE Username='$Username'";
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
