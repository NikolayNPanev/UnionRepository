<?php
function Disconnect($conn){
    mysqli_close($conn);
  }
////////////////////////////////////////////////////////////////////
function Insert1($TABLE,$COLUMN,$VALUE){
include("Connect.php");
$sql = "INSERT INTO $TABLE($COLUMN) VALUES('$VALUE')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}
////////////////////////////////////////////////////////////////////
function Insert2($TABLE,$COLUMN1,$COLUMN12,$VALUE1,$VALUE2){
include("Connect.php");
$sql = "INSERT INTO $TABLE($COLUMN1,$COLUMN2) VALUES('$VALUE1','$VALUE2')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}
//////////////////////////////////////////////////////////////////////
function Insert3($TABLE,$COLUMN1,$COLUMN2,$COLUMN3,$VALUE1,$VALUE2,$VALUE3){
include("Connect.php");
$sql = "INSERT INTO $TABLE($COLUMN1,$COLUMN2,$COLUMN3) VALUES('$VALUE1','$VALUE2','$VALUE3')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}
function Insert4($TABLE,$COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4,$VALUE1,$VALUE2,$VALUE3,$VALUE4){
include("Connect.php");
$sql = "INSERT INTO $TABLE ($COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4) VALUES ('$VALUE1','$VALUE2','$VALUE3','$VALUE4')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}


//returns true if the username is available
function CheckUsernameAvailability($Username){
  include("Connect.php");
  $query = "SELECT * FROM Credentials WHERE Username='$Username';";

  if(mysqli_query($conn, $query)){
    $result = $conn->query($query);

    if ($result->num_rows > 0)
    {
      Disconnect($conn);
      return 0;
    }
  }
  Disconnect($conn);
  return 1;
}

function CheckPassword($Username,$Password){
  include("Connect.php");
  $query = "SELECT * FROM Credentials WHERE Username='$Username' AND Password='$Password';";

  if(mysqli_query($conn, $query)){
    $result = $conn->query($query);

    if ($result->num_rows > 0)
    {
      Disconnect($conn);
      return 1;
    }
  }
  Disconnect($conn);
  return 0;
}


////////////////////////////////////////////////////////////////////////
function test(){
  include("Connect.php");
  $dbname="BankOfKolyo";
$dbname2="BankOfVeni";
//$dbname3="Credentials";

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
      echo "IBAN: " . $row["IBAN"]. "<br> - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      }
    }
    if ($result2->num_rows > 0) {
      // output data of each row
      while($row = $result2->fetch_assoc()) {
      echo "IBAN: " . $row["IBAN"]. "<br> - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
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