<?php
	include("Connect.php");
	include("DBFunc.php");
	
	$url= $_SERVER['REQUEST_URI'];    
	$pos = strpos($url, "iban=") + 5;
	$iban = substr($url, $pos);

	if (strpos($iban, "BOKB") !== false) { $bankName = "Bank of Kolyo"; $bankNameSql = "BankOfKolyo"; }
  if (strpos($iban, "BOVB") !== false) { $bankName = "Bank of Veni"; $bankNameSql = "BankOfVeni"; }

  $sql = "SELECT * FROM $bankNameSql WHERE IBAN='$iban'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$firstname = $row["firstname"];
	$lastname = $row["lastname"];
	$bal = $row["Balance"];
	$currency = "lv.";
	Disconnect($conn);
  ?>
