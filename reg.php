<?php
	include("DBFunc.php");
	include("Generator.php");
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$Username = $_POST['username'];
	$password = $_POST['password'];
	$bank = $_POST['bankName'];
	$IBAN = GenerateIban($bank);
	$UsernameAvailability = CheckUsernameAvailability($Username);
	if( $UsernameAvailability== 1){
		Insert4($bank,"firstname","lastname","Balance","IBAN",$fname,$lname,"0",$IBAN);
		Insert3("Credentials","username","password","IBAN",$Username,$password,$IBAN);
		header("Location: landing.php");
		exit();
	}
	else
	echo '<script>alert("USERNAME ALREADY TAKEN")</script>';
	exit();
	


	
?>

<script>
	

</script>