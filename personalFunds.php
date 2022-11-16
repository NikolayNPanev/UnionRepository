<?php
	include("InterfaceVariables.php");
	include("Connect.php");

	if ( empty($_GET["removedFunds"]) && empty($_GET["addedFunds"]) ) {
		echo "<script>alert('Error: You need to incude an amount!');location='interface.php?iban=$iban';</script>";
	}

	if ( isset($_GET["addedFunds"]) && empty($_GET["removedFunds"]) ) {
		$funds = $_GET["addedFunds"];

		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$resultLocal = $conn->query($sql);
	    $row = $resultLocal->fetch_assoc();
	    $balance = $row["Balance"];
	    $newBalance = $balance + $funds;

	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		Disconnect($conn);
		echo "<script>alert('Succesfully added $funds $currency');location='interface.php?iban=$iban';</script>";
	}

	if ( isset($_GET["removedFunds"]) && empty($_GET["addedFunds"]) ) {
		$funds = $_GET["removedFunds"];

		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$result = $conn->query($sql);
	    $row = $result->fetch_assoc();
	    $balance = $row["Balance"];
	    $newBalance = $balance - $funds;

	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		Disconnect($conn);
		echo "<script>alert('Succesfully removed $funds $currency');location='interface.php?iban=$iban';</script>";
	}

	if ( ($_GET["removedFunds"]) && ($_GET["addedFunds"]) ) {
		echo "<script>alert('Error: You cannot add and remove funds at the same time!');location='interface.php?iban=$iban';</script>";
	}