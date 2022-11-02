<!DOCTYPE html>
<html>
<body>
<script src="funds.js"></script> 

<?php 
        include("InterfaceVariables.php");
	include("DBFunc.php");
        //Login Credentials
        
        
        
        //Important constants
        $currency = "lv.";
        

        
	echo "
	<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>
	<p> You currently have $bal $currency </p>";

        echo " <a href='transactionHistory.php?username=$Username'><button style='width: 300px'>Transaction History</button></a>
        <p><a href='sendFunds.php?username=$Username'><button style='width: 300px'>Send Funds</button></a>

        <form method='post' action='personalFunds.php?username=$Username'>
        <input type='submit' value='Add funds' style='width: 100px'> <input type='text' name='addedFunds' style='width: 190px'>
        <br><p><input type='submit' value='Remove funds' style='width: 100px'> <input type='text' name='removedFunds' style='width: 190px'>
        <input type='hidden' name='username' value='$Username'>
        </form>
        <p><button style='width: 300px'>Log out</button>";
        

    
        
		
	Disconnect($conn);



?>
 </body>	
 </html>
