<?php
	include "InterfaceVariables.php";

	echo "<p> You currently have $bal $currency </p>";
?>
Please enter the information of the recepient and the amount:
<form method="get" action="sendFunds.php">
	
	<table>
		<tr><td>First Name:</td><td><input type="text" name="recepientFirstName"  required></td>
		<tr><td>Last Name:</td><td><input type="text" name="recepientLastName" class='sendFunds' required></td>
		<tr><td>IBAN:</td><td><input type="text" class="sendFunds" name="recepientIBAN"  required></td>
		<tr><td>Amount:</td><td><input type="text" class="sendFunds" name="recepientAmount" required></td>
		<tr><td>Reason:</td><td><input type="text" class="sendFunds" name="reason" required></td>
		<tr><td colspan=2><input type="submit" class="sendFunds" name="submit" value="Send Funds" style="width:100%;"></td>
	</table>
	<input type="hidden" name="iban" value="<?php echo $iban;?>">
</form>

<a href='interface.php?iban=<?php echo $iban;?>'><button>Return to Main Page</button></a>
<?php 
	include("Connect.php");
	$query = "SELECT IBAN FROM BankOfKolyo";
	$result = $conn->query($query);
	foreach ($result as $row) {
    echo "<br>".$row['IBAN'];
}

    $query = "SELECT IBAN FROM BankOfVeni";
	$result = $conn->query($query);
	foreach ($result as $row) {
    echo "<br>".$row['IBAN'];
}
	Disconnect($conn);