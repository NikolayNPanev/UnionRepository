<?php

function Disconnect($conn){
    mysqli_close($conn);
  }
	function Connect(){
		

	}
function test(){
  include("connect.php");
  $dbname="BankOfKolyo_Clients";
$dbname2="BankOfVeni_Clients";
//$dbname3="Credentials";

$conn = new mysqli($servername, $username, $password,$database);

/*try {
  $sql = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  // set the PDO error mode to exception
  $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
*/
$sql = "SELECT * FROM $dbname ORDER BY IBAN;";
$sql2 = "SELECT * FROM $dbname2 ORDER BY IBAN;";
//$sql3 = "SELECT * FROM $dbname3;";

if(mysqli_query($conn, $sql)){
  $result = $conn->query($sql);
  $result2 = $conn->query($sql2);
  //$result3 = $conn->query($sql3);
    echo "Success!<br>";

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      echo "IBAN: " . $row["IBAN"]. "<br> - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
      }
    }
    if ($result2->num_rows > 0) {
      // output data of each row
      while($row = $result2->fetch_assoc()) {
      echo "IBAN: " . $row["IBAN"]. "<br> - Name: " . $row["FirstName"]. " " . $row["LastName"]. "<br>";
      }
    }
    /*
    if ($result3->num_rows > 0) {
      // output data of each row
      while($row = $result3->fetch_assoc()) {
      echo "Username: " . $row["Username"]. "<br> - Password: " . $row["Password"]."<br>";
      }
      */
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn); 
}
 
// Close connection
Disconnect($conn);
}
?>