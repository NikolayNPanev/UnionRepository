<?php
	include("InterfaceVariables.php");
	include("Connect.php");

	if ( empty($_GET["removedFunds"]) && empty($_GET["addedFunds"]) ) {
		echo "<script>alert('Грешка: Трябва да добавиш сума!);location='interface.php?iban=$iban';</script>";
	}

	if ( isset($_GET["addedFunds"]) && empty($_GET["removedFunds"]) ) {
		$funds = floatval($_GET["addedFunds"]);
		if($funds <= 0) {
			echo "<script>alert('Грешка: Моля въведете валидно число');location='interface.php?iban=$iban';</script>";
			return;
		}

		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$resultLocal = $conn->query($sql);
	    $row = $resultLocal->fetch_assoc();
	    $balance = $row["Balance"];

    	$newBalance = $balance + $funds;

	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		Disconnect($conn);
		echo "<script>alert('Успешно внесени $funds $currency');location='interface.php?iban=$iban';</script>";
	}

	if ( isset($_GET["removedFunds"]) && empty($_GET["addedFunds"]) ) {
		$funds = floatval(_GET["removedFunds"]);
		if($funds <= 0) {
			echo "<script>alert('Грешка: Моля въведете валидно число');location='interface.php?iban=$iban';</script>";
			return;
		}


		$sql = "SELECT Balance FROM $bankNameSql WHERE IBAN='$iban'";
		$result = $conn->query($sql);
	    $row = $result->fetch_assoc();
	    $balance = $row["Balance"];
	    if($balance < $funds) {
	    	echo "<script>alert('Грешка: Недостатъчни средства');location='interface.php?iban=$iban';</script>";
	    	return;
	    }

    	$newBalance = $balance - $funds;
	   
		$sql = "UPDATE $bankNameSql SET Balance='$newBalance' WHERE IBAN='$iban'";
		$conn->query($sql);
		Disconnect($conn);
		echo "<script>alert('Успешно изтеглени $funds $currency');location='interface.php?iban=$iban';</script>";
	}

	if ( ($_GET["removedFunds"]) && ($_GET["addedFunds"]) ) {
		echo "<script>alert('Грешка: Не може да добавиш и премахнеш пари едновременно');location='interface.php?iban=$iban';</script>";
	}