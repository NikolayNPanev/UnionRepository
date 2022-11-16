<!DOCTYPE html>
<html>
<body>

<?php 
        include("InterfaceVariables.php");    
        
	echo "
	<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>
	<p> You currently have $bal $currency </p>";
  
  ?>
  
  <table>
        <tr>
                <td colspan=2><a href='<?php echo "transactionHistoryInterface.php?iban=$iban";?>'><button class='interfaceDouble'>Transaction History</button></a></td>
        </tr>
        <tr>
                <td colspan=2><a href='<?php echo "sendFundsInterface.php?iban=$iban";?>'><button class='interfaceDouble'>Send Funds</button></a></td>
        </tr>
        <form method='get' action='personalFunds.php'>
        <tr>
                <td><input type='submit' value='Add funds' class='interfaceDouble'></td> 
                <td><input type='text' name='addedFunds' class='interfaceDouble'></td>
        </tr>
        <tr>
                <td><input type='submit' value='Remove funds' class='interfaceDouble'></td>
                <td><input type='text' name='removedFunds' class='interfaceDouble'></td>
        </tr>
        <input type='hidden' name='iban' value='<?php echo $iban;?>'>
        </form>
</table>



<br><a href='landing.php'><button >Log out</button></a>
        
 </body>	
 </html>
