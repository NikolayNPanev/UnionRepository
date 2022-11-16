<!DOCTYPE html>
<html>
<body>

<?php 
        include("InterfaceVariables.php");    
        
	echo "
	<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>
	<p> You currently have $bal $currency </p>";
  
  ?>
        <a href='<?php echo "transactionHistoryInterface.php?iban=$iban";?>'><button style='width: 300px'>Transaction History</button></a>
        <p><a href='<?php echo "sendFundsInterface.php?iban=$iban";?>'><button style='width: 300px'>Send Funds</button></a>

        <form method='get' action='personalFunds.php'>
        <input type='submit' value='Add funds' > <input type='text' name='addedFunds' >
        <br><p><input type='submit' value='Remove funds' > <input type='text' name='removedFunds' >
        <input type='hidden' name='iban' value='<?php echo $iban;?>'>
        </form>

        <p><a href='landing.php'><button >Log out</button></a>
        
 </body>	
 </html>
