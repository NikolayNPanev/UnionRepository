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
	$IBAN = GenerateIban($bank);
	//This function returns true(1) if the username doesn't exist;
	$UsernameAvailability = CheckUsernameAvailability($Username);

	//if the username doesn't exist, inser a user with the credentials entered
	if( $UsernameAvailability== 1){
		Insert4($bank,"firstname","lastname","Balance","IBAN",$fname,$lname,"0",$IBAN);
		Insert3("Credentials","username","password","IBAN",$Username,$password,$IBAN);
		header("Location: landing.php");
		exit();
	}
	//if the username does exist, alert the user and redirect him to the registration page
	else{
	echo '<script>alert("USERNAME ALREADY TAKEN")</script>';
	exit();
	}
?>

<script>
	

</script>