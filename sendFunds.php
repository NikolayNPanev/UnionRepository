<?php 
include("InterfaceVariables.php");
include("DBFunc.php");
echo "this is where we process your sent funds, bitch ($Username)";



$recepientIBAN = $_GET['recepientIBAN'];
$recepientAmount = $_GET['recepientAmount'];
$reason = $_GET['reason'];

sendFunds($iban, $recepientIBAN, $recepientAmount, $reason);



