<?php
	include ("InterfaceVariables.php");

	if ( empty($_GET["removedFunds"]) && empty($_GET["addedFunds"]) ) {
		header("Location: ./interface.php?iban=$iban");
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
		header("Location: ./interface.php?iban=$iban");
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
		header("Location: ./interface.php?iban=$iban");
	}

	if ( ($_GET["removedFunds"]) && ($_GET["addedFunds"]) ) {
		header("Location: ./interface.php?iban=$iban");
	}