<?php
	include "interfaceVariables.php";

	echo "<p> You currently have $bal $currency </p>";
?>
Please enter the information of the recepient and the amount:
<form method="post" action="sendFunds.php">
	
	<table>
		<tr><td>First Name:</td><td><input type="text" name="recepientFirstName" style="width: 190px" required></td>
		<tr><td>Last Name:</td><td><input type="text" name="recepientLastName" style="width: 190px" required></td>
		<tr><td>IBAN:</td><td><input type="text" name="recepientIBAN" style="width: 190px" required></td>
		<tr><td>Amount:</td><td><input type="text" name="recepientAmount" style="width: 190px" required></td>
		<tr><td colspan=2><input type="submit" name="submit" value="Send Funds" style="width: 270px"></td>
	</table>
	<input type="hidden" name="username" value="<?php echo $Username;?>">
</form>
<?php
echo "<a href='interface.php?username=$Username'><button>Return to Main Page</button></a>"; ?>