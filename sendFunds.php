<?php 
include("InterfaceVariables.php");

$recepientIBAN = $_GET['recepientIBAN'];
$recepientAmount = $_GET['recepientAmount'];
$reason = $_GET['reason'];

echo sendFunds($iban, $recepientIBAN, $recepientAmount, $reason);



