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

while($row = mysqli_fetch_assoc($result)){
	echo $row['TransactionDate'] . "<br>";
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
</table>

