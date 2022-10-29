<?php
include("DBFunc.php");

$Username = $_POST['username'];
$password = $_POST['password'];
//This function returns true if the account doesn't exist
$NOT_accountExists = CheckUsernameAvailability($Username);
$CorrectPassword = CheckPassword($Username,$password);

if($NOT_accountExists == 0 AND $CorrectPassword == 1){
	echo '<script>alert("Welcome, $Username");location="landing.php";</script>';
	exit();
}

echo '<script>alert("Invalid Login Details! Please Try Again!");location="Login.php";</script>';

exit();
?>