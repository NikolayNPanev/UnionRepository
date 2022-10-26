<!DOCTYPE html>
<html>
<body>

<?php 
        include "functions.php";
        
        //Login Credentials
        $dbservername = "sql11.freemysqlhosting.net";
        $dbusername = "sql11524679";
        $dbpassword = "VdUtWRxRUf";
        $database = "sql11524679";
        
        
        //Important constants
        $currency = "lv.";
        
	//$dbname="BankOfKolyo";
	$conn = new mysqli($dbservername, $dbusername, $dbpassword,$database);

	try {	$sql = new PDO("mysql:host=$dbservername;dbname=$database", $dbusername, $dbpassword);
	// set the PDO error mode to exception
	$sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connected successfully";
	} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	}

	$username = "TestUser2";

	$sql = "SELECT IBAN FROM Credentials WHERE Username='$username'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$iban = $row["IBAN"];
        

        //if (str_contains($iban, "BOVB"))
        if (strpos($iban, "BOKB") !== false) { $bankName = "Bank of Kolyo"; $bankNameSql = "BankOfKolyo"; }
        if (strpos($iban, "BOVB") !== false) { $bankName = "Bank of Veni"; $bankNameSql = "BankOfVeni"; }

        $sql = "SELECT * FROM $bankNameSql WHERE IBAN='$iban'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        $bal = $row["Balance"];
        
	echo "<h1> Welcome to the bank of $bankName, $firstname $lastname</h1>";
        
        echo "<p> You currently have $bal $currency</p>";
        
        ?>
    
        <a href="transactionHistory.php"><button >Transaction History</button></a>
        <br><button onclick="addFunds()">Add funds</button>
        <br><button id="removeFunds">Remove funds</button>
    
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