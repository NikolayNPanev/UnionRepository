<!DOCTYPE html>
<html>
<body>
<script src="funds.js"></script> 

<?php 
        include("InterfaceVariables.php");    
        
	echo "
	<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>
	<p> You currently have $bal $currency </p>";?>

        <a href='<?php echo "transactionHistory.php?iban=$iban";?>'><button style='width: 300px'>Transaction History</button></a>
        <p><a href='<?php echo "sendFundsInterface.php?iban=$iban";?>'><button style='width: 300px'>Send Funds</button></a>

        <form method='get' action='personalFunds.php'>
        <input type='submit' value='Add funds' style='width: 100px'> <input type='text' name='addedFunds' style='width: 190px'>
        <br><p><input type='submit' value='Remove funds' style='width: 100px'> <input type='text' name='removedFunds' style='width: 190px'>
        <input type='hidden' name='iban' value='<?php echo $iban;?>'>
        </form>
        <p><a href='landing.php'><button style='width: 300px'>Log out</button></a>
        

    
        
	<?php	
	Disconnect($conn); 
        ?>




 </body>	
 </html>
