<style>
	td {
		text-align:  center;
	}
</style>

<?php

include("InterfaceVariables.php");
//Fetching the start and end date and setting a custom format
$startDate = date("j M, Y", strtotime($_GET['startDate']));
$endDate = date("j M, Y", strtotime($_GET['endDate']));

//Checking if either is empty and giving the user an error
if(empty($_GET["startDate"])) {
	echo "<script>alert('Error: Please specify a start date');location='transactionHistoryInterface.php?iban=$iban';</script>";
}

if(empty($_GET["endDate"])) {
	echo "<script>alert('Error: Please specify an end date');location='transactionHistoryInterface.php?iban=$iban';</script>";
}


$result = transactionHistory($iban, $startDate, $endDate);

function displayHistory($result, $IBAN, $currency){
	while($row = mysqli_fetch_assoc($result)){
		echo "<tr>";
		$date =  date("j M, Y", strtotime($row['TransactionDate']));;
		$note = $row['Note'];
		if($IBAN == $row['RecipientIBAN']){
			$foreignIBAN = $row['SenderIBAN'];
			$amount = "<td style='color:MediumSeaGreen'>+" . strval(number_format($row["Amount"], 2, '.', '')) . " $currency</td>";
		} else if($IBAN == $row['SenderIBAN']) {
			$foreignIBAN = $row['RecipientIBAN'];
			$amount = "<td style='color:Tomato'>-" . strval(number_format($row["Amount"], 2, '.', '')) . " $currency</td>";

		}
		$foreignBank = bankName($foreignIBAN);
		$firstName = fetchValue('IBAN', $foreignIBAN, $foreignBank, "firstname");
		$lastName = fetchValue("IBAN", $foreignIBAN, $foreignBank, "lastname");
		$name = $firstName . " " . $lastName;
		 echo "<td>" . $date . "</td>";
		 echo "<td>" . $name . "</td>";
		 echo "<td>" . $note . "</td>";
		 echo $amount . "</tr>";
	}
}

?>

<table>
	<tr>
		<td colspan='4'>Transaction History</td>
	</tr>
	<tr>
		<td colspan='2'>From</td>
		<td colspan='2'>To</td>
	</tr>
	<tr>
		<td colspan='2'><?php echo $startDate;?></td>
		<td colspan='2'><?php echo $endDate;?></td>
	</tr>
	<tr>
		<td>Date</td>
		<td>Name</td>
		<td>Note</td>
		<td>Amount</td>
	</tr>
	<?php displayHistory($result, $iban, $currency);?>
</table>
<br><a href='interface.php?iban=<?php echo $iban;?>'><button>Return to Main Page</button></a>
<a href='transactionHistoryInterface.php?iban=<?php echo $iban;?>'><button>Back</button></a>

