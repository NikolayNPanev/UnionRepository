<?php
echo "<link rel='stylesheet' href='BoKStyle.css'>";

include("bankNumberSelector.php");
  function CreateTables(){
  $sql = "CREATE TABLE BankOfKolyo (
  IBAN VARCHAR(37) PRIMARY KEY,
  firstname VARCHAR(30) NOT NULL,
  lastname VARCHAR(30) NOT NULL,
  username VARCHAR(50),
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  balance DOUBLE(40,0);
  )";

  if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
  } else {
    echo "Error creating table: " . $conn->error;
  }

  $conn->close();
}

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
function Insert2($TABLE,$COLUMN1,$COLUMN2,$VALUE1,$VALUE2){
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

////////////////////////////////////////////////////////////////////////
function Insert5($TABLE,$COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4,$COLUMN5,$VALUE1,$VALUE2,$VALUE3,$VALUE4,$VALUE5){
//database credentials
include("Connect.php");
$sql = "INSERT INTO $TABLE ($COLUMN1,$COLUMN2,$COLUMN3,$COLUMN4, $COLUMN5) VALUES ('$VALUE1','$VALUE2','$VALUE3','$VALUE4','$VALUE5')";

  //On a failed insert
  if ($conn->query($sql) === FALSE) {

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
  return "wrong";
}
///////////////////////////////
//                           //
//   CREDENTIALS FUNCTIONS   //
//                           //
///////////////////////////////


//Returns true if the username doesn't exist in the database
function CheckUsernameAvailability($Username,$bankNumber){
  //database credentials
  include("Connect.php");
  //Ask the database for the entry with that username

  $bank=getBank($bankNumber);

  $query = "SELECT * FROM $bank WHERE Username='$Username';";

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
//  MAIN FUNCTIONALITY FUNCS //
//                           //
///////////////////////////////

function sendFunds($senderIBAN, $recepientIBAN, $amount, $reason, $currency){
  ///Check if user submitted his own IBAN
  if ($senderIBAN == $recepientIBAN) return "<script>alert('Error: You cannot send yourself money');location='sendFundsInterface.php?iban=$senderIBAN';</script>";

  //Check if amount is 0 or negative
  if ($amount <= 0) return "<script>alert('Error: You must send a positive amount of money');location='sendFundsInterface.php?iban=$senderIBAN';</script>";

  //Check if Recepient IBAN exists
  include("Connect.php");

  $recepientBank = bankName($recepientIBAN);

  if ($recepientBank == "wrong") return "<script>alert('Error: No such IBAN exists');location='sendFundsInterface.php?iban=$senderIBAN';</script>";

  $query = "SELECT * FROM $recepientBank WHERE IBAN='$recepientIBAN';";

  if(mysqli_query($conn, $query)){
    //Get what the database has answered
    $result = $conn->query($query);

    //If there isn't and entry with this IBAN,
    //disconnect from the database and return
    if ($result->num_rows <= 0)
    {
      Disconnect($conn);
      return "<script>alert('Error: No such IBAN exists');location='sendFundsInterface.php?iban=$senderIBAN';</script>";
    }

    //Check if Sender has enough money

    $senderBank = bankName($senderIBAN);

    $senderBal = fetchValue("IBAN", $senderIBAN, $senderBank, "Balance");

    if($senderBal < $amount) return "<script>alert('Error: You do not have enough funds');location='sendFundsInterface.php?iban=$senderIBAN';</script>";

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
    Insert5("Transactions", "TransactionDate", "SenderIBAN", "RecipientIBAN", "Amount", "Note", date('y-m-d-H:i:s'), $senderIBAN, $recepientIBAN, $amount, $reason);
    return "<script>alert('Successfully sent $amount $currency');location='sendFundsInterface.php?iban=$senderIBAN';</script>";
  }
}

function transactionHistory($IBAN, $StartDate, $EndDate){
  include("Connect.php");
  $StartDate = date("Ymd", strtotime($StartDate));
  $EndDate = date("Ymd", strtotime($EndDate . ' +1 day'));
  //Sent funds query
  $query = "SELECT TransactionDate, SenderIBAN, RecipientIBAN, Amount, Note FROM Transactions WHERE (SenderIBAN='$IBAN' OR RecipientIBAN='$IBAN') AND (TransactionDate >= '$StartDate' AND TransactionDate <= '$EndDate') ORDER BY TransactionDate DESC;";
  if(mysqli_query($conn, $query)){
    //Get what the database answered
    $result = $conn->query($query);
    return $result;
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