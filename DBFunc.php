<?php
////////////////////
//                //
//   DISCONNECT   //
//                //
////////////////////
function Disconnect($conn){
    mysqli_close($conn);
  }





///////////////////////////
//                       //
//    INSERT FUNCTIONS   //
//                       //
///////////////////////////
function Insert1($TABLE,$COLUMN,$VALUE){
//database credentials
include("Connect.php");
//tell the database what to insert and into which table
$sql = "INSERT INTO $TABLE($COLUMN) VALUES('$VALUE')";

  //On a successfull insert
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } 
  //On a failed insert
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}



////////////////////////////////////////////////////////////////////
function Insert2($TABLE,$COLUMN1,$COLUMN12,$VALUE1,$VALUE2){
//database credentials
include("Connect.php");
$sql = "INSERT INTO $TABLE($COLUMN1,$COLUMN2) VALUES('$VALUE1','$VALUE2')";
  
  //On a successfull insert
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } 
  //On a failed insert
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}



//////////////////////////////////////////////////////////////////////
function Insert3($TABLE,$COLUMN1,$COLUMN2,$COLUMN3,$VALUE1,$VALUE2,$VALUE3){
//database credentials
include("Connect.php");
$sql = "INSERT INTO $TABLE($COLUMN1,$COLUMN2,$COLUMN3) VALUES('$VALUE1','$VALUE2','$VALUE3')";

  //On a successfull insert
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } 
  //On a failed insert
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}



////////////////////////////////////////////////////////////////////////
function Insert4($TABLE,$COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4,$VALUE1,$VALUE2,$VALUE3,$VALUE4){
//database credentials
include("Connect.php");
$sql = "INSERT INTO $TABLE ($COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4) VALUES ('$VALUE1','$VALUE2','$VALUE3','$VALUE4')";

  //On a successfull insert
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } 
  //On a failed insert
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  Disconnect($conn);
}

///////////////////////////////
//                           //
//      FETCH FUNCTIONS      //
//                           //
///////////////////////////////

//"Username", $Username, $bank, "IBAN");
function fetchValue($checkCol, $checkValue, $table, $value){
  //database credentials
  include("Connect.php");
  //Select the Value from the appropriate bank

  $query = "SELECT $value FROM $table WHERE $checkCol='$checkValue';";

  echo $query;

  //Get what the database has answered
  $result = $conn->query($query);
  $row = $result->fetch_assoc();
  $fetchedValue = $row[$value];
  Disconnect($conn);
  return $fetchedValue;
}

function bankName($iban){
  if (strpos($iban, "BOKB") !== false) return "BankOfKolyo";
  if (strpos($iban, "BOVB") !== false) return "BankOfVeni";
}
///////////////////////////////
//                           //
//   CREDENTIALS FUNCTIONS   //
//                           //
///////////////////////////////


//Returns true if the username doesn't exist in the database
function CheckUsernameAvailability($Username){
  //database credentials
  include("Connect.php");
  //Ask the database for the entry with that username
  $query = "SELECT * FROM Credentials WHERE Username='$Username';";

  if(mysqli_query($conn, $query)){
    //Get what the database has answered
    $result = $conn->query($query);

    //If there is an entry with that username,
    //disconnect and return false
    if ($result->num_rows > 0)
    {
      Disconnect($conn);
      return 0;
    }
  }
  //If the username is not taken yet,
  //disconnect and return true
  Disconnect($conn);
  return 1;
}




//////////////////////////////////////////////////////////////////////////
//Checks if the user password is correct ,and returns true(1) if correct
function CheckPassword($Username,$Password){
  //database credentials
  include("Connect.php");

  //Ask the database for the entry with these username and password
  $query = "SELECT * FROM Credentials WHERE Username='$Username' AND Password='$Password';";

  if(mysqli_query($conn, $query)){
    //Get what the database has answered
    $result = $conn->query($query);

    //If there is and entry with these username and password,
    //disconnect from the database and return true(1)
    if ($result->num_rows > 0)
    {
      Disconnect($conn);
      return 1;
    }
  }
  //if there isn't a user like this or the password doesn't match,
  //disconnect and return false(0)
  Disconnect($conn);
  return 0;
}

//Checks if the user has the correct bank selected, and returns true(1) if corret
function CheckBank($Username, $bank){
  //database credentials
  include("Connect.php");
  //Asks the database for an entry in the bank with this username
  $query = "SELECT Username FROM $bank WHERE Username='$Username';";

  if(mysqli_query($conn, $query)){
    //Get what the database has answered
    $result = $conn->query($query);

    //If there is an entry in the bank with this username,
    //disconnect from the database and return true(1)
    if ($result->num_rows > 0){
      Disconnect($conn);
      return 1;
    }
  }
  //if there isn't a username in this bank
  //disconnect and return false(0)
  Disconnect($conn);
  return 0;
}


///////////////////////////////
//                           //
//   FUND TRANSFER FUNCTIONS //
//                           //
///////////////////////////////

function sendFunds($senderIBAN, $recepientIBAN, $amount, $reason){
  ///Check if user submitted his own IBAN
  if ($senderIBAN == $recepientIBAN) return;

  //Check if amount is 0 or negative
  if ($amount <= 0) return;

  //Check if Recepient IBAN exists
  include("Connect.php");

  $recepientBank = bankName($recepientIBAN);

  $query = "SELECT * FROM $recepientBank WHERE IBAN='$recepientIBAN';";

  if(mysqli_query($conn, $query)){
    //Get what the database has answered
    $result = $conn->query($query);

    //If there isn't and entry with this IBAN,
    //disconnect from the database and return
    if ($result->num_rows <= 0)
    {
      Disconnect($conn);
      return;
    }

    //Check if Sender has enough money

    $senderBank = bankName($senderIBAN);

    $senderBal = fetchValue("IBAN", $senderIBAN, $senderBank, "Balance");

    if($senderBal < $amount) return;

    //Update sender balance
    $senderBal -= $amount;
    $sql = "UPDATE $senderBank SET Balance=$senderBal WHERE IBAN='$senderIBAN';";
    $conn->query($sql);

    //Update recepient balance
    $recepientBal = fetchValue("IBAN", $recepientIBAN, $recepientBank, "Balance");
    $recepientBal += $amount;
    $sql = "UPDATE $recepientBank SET Balance=$recepientBal WHERE IBAN='$recepientIBAN';";
    $conn->query($sql);
    Disconnect($conn);
    //to-do: add transaction history

  }



}

/////////////////////////
//                     //
//   TEST  FUNCTIONS   //
//                     //
/////////////////////////
function test(){
  //database credentials
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