<!DOCTYPE html>
<html>
<body>
<script src="funds.js"></script> 

<?php 
        include "databaseConnection.php";
        //Login Credentials
        
        
        
        //Important constants
        $currency = "lv.";
        

        
	echo "
	<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>
	<p> You currently have $bal $currency </p>";
        
        ?>
    
        <a href="transactionHistory.php"><button style="width: 300px">Transaction History</button></a>
        <p><a href="sendFunds.php"><button style="width: 300px">Send Funds</button></a>

        <form method="get" action="personalFunds.php">
        <input type="submit" value="Add funds" style="width: 100px"> <input type="text" name="addedFunds" style="width: 190px">
        <br><p><input type="submit" value="Remove funds" style="width: 100px"> <input type="text" name="removedFunds" style="width: 190px">
        </form>
        <p><button style="width: 300px">Log out</button>
    
        <?php// $sql = "INSERT INTO Credentials (Username, Password, IBAN) VALUES ('TestUser2','123456','BG01BOVB');";

	// if(mysqli_query($conn, $sql)){
	// echo "Records inserted successfully.";
	// } else{
	// echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
	// }

	// Close connection

	mysqli_close($conn);



?>
 </body>	
 </html>