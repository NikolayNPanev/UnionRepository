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
	<p> You currently have $bal $currency </p>";?>

        <a href='<?php echo "transactionHistory.php?iban=$iban";?>'><button>Transaction History</button></a>
        <p><a href='<?php echo "sendFundsInterface.php?iban=$iban";?>'><button >Send Funds</button></a>

        <form method='get' action='personalFunds.php'>
        <input type='submit' value='Add funds' > <input type='text' name='addedFunds' >
        <br><p><input type='submit' value='Remove funds' > <input type='text' name='removedFunds' >
        <input type='hidden' name='iban' value='<?php echo $iban;?>'>
        </form>
        <p><a href='landing.php'><button >Log out</button></a>
        

    
        
	<?php	
	Disconnect($conn); 
        ?>




 </body>	
 </html>
