<!DOCTYPE html>
<html>
<body>

<?php 
        include("InterfaceVariables.php");    
        
	echo "
	<h1> Добре дошли в приложението на $bankName, $firstname $lastname!</h1>
	<p> Баланс: $bal $currency </p>";
  
  ?>
  
  <table>
        <tr>
                <td colspan=2><a href='<?php echo "transactionHistoryInterface.php?iban=$iban";?>'><button class='interfaceDouble'>История на Транзакциите</button></a></td>
        </tr>
        <tr>
                <td colspan=2><a href='<?php echo "sendFundsInterface.php?iban=$iban";?>'><button class='interfaceDouble'>Направи Транзакция</button></a></td>
        </tr>
        <form method='get' action='personalFunds.php'>
        <tr>
                <td><input type='submit' value='Внеси пари' class='interfaceDouble'></td> 
                <td><input type='text' name='addedFunds' class='interfaceDouble'></td>
        </tr>
        <tr>
                <td><input type='submit' value='Изтегли пари' class='interfaceDouble'></td>
                <td><input type='text' name='removedFunds' class='interfaceDouble'></td>
        </tr>
        <input type='hidden' name='iban' value='<?php echo $iban;?>'>
        </form>
</table>



<br><a href='landing.php'><button >Излез</button></a>
        
 </body>	
 </html>
