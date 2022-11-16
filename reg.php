<?php
	include("DBFunc.php");
	include("Generator.php");
	
	//Get the user input
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$Username = $_POST['username'];
	$password = $_POST['password'];
	$bank = $_POST['bankName'];
	//Generate an IBAN in case the registration is successfull
	$IBANGen = GenerateIban($bank);
	$IBAN = $IBANGen;
	//This function returns true(1) if the username doesn't exist;
	$bankNumber=bankNumber($bank);
	$UsernameAvailability = CheckUsernameAvailability($Username,$bankNumber);

	//if the username doesn't exist, inser a user with the credentials entered
	if( $UsernameAvailability== 1){
		Insert5($bank,"firstname","lastname","Balance","IBAN","Username",$fname,$lname,"0",$IBAN,$Username);
		Insert3("Credentials","username","password","IBAN",$Username,$password,$IBAN);
		header("Location: interface.php?iban=$IBAN");
		exit();
	}
	//if the username does exist, alert the user and redirect him to the registration page
	else{
	echo "<script>alert('Username Already Taken! Please Try Again!');location='Register.php?fname=$fname&lname=$lname&username=$Username&bankName=$bank';</script>";

	exit();
	}
?>

