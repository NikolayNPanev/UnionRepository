<?php
	include ("InterfaceVariables.php");

	if ( empty($_POST["removedFunds"]) && empty($_POST["addedFunds"]) ) {
		header("Location: ./interface.php?username=$Username");
	}

	if ( isset($_POST["addedFunds"]) && empty($_POST["removedFunds"]) ) {
		$funds = $_POST["addedFunds"];

		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$resultLocal = $conn->query($sql);
	    $row = $resultLocal->fetch_assoc();
	    $balance = $row["Balance"];
	    $newBalance = $balance + $funds;

	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		header("Location: ./interface.php?username=$Username");
	}

	if ( isset($_POST["removedFunds"]) && empty($_POST["addedFunds"]) ) {
		$funds = $_POST["removedFunds"];

		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$result = $conn->query($sql);
	    $row = $result->fetch_assoc();
	    $balance = $row["Balance"];
	    $newBalance = $balance - $funds;

	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		header("Location: ./interface.php?username=$Username");
	}

	if ( empty($_POST["removedFunds"]) && empty($_POST["addedFunds"]) ) {
		header("Location: ./interface.php?username=$Username");
	}