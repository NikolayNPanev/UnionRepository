
<?php
include("DBFunc.php");

//Get the user input
$Username = $_POST['username'];
$password = $_POST['password'];
$bank = $_POST['bank'];

$bankNumber=bankNumber($bank);
//This function returns true if the account doesn't exist

$NOT_accountExists = CheckUsernameAvailability($Username,$bankNumber);
//This returns true if the password matches
$CorrectPassword = CheckPassword($Username,$password);
//This return true if the bank matches
$CorrectBank = CheckBank($Username, $bank);

//if the passwords and username match the database, show an allert and redirect the page
if($NOT_accountExists == 0 AND $CorrectPassword == 1 AND $CorrectBank == 1){
	$iban = fetchValue("Username", $Username, $bank, "IBAN");
	echo "<script>alert('Welcome, $Username');location='interface.php?iban=$iban';</script>";
	exit();
}

//if the credentials do not match, alert the person and send them back to the login page to try again
echo "<script>alert('Invalid Login Details! Please Try Again!');location='Login.php?username=$Username';</script>";

exit();
?>
