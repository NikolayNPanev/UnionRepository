<?php 
include("InterfaceVariables.php");

$recepientIBAN = $_GET['recepientIBAN'];
$recepientAmount = floatval($_GET['recepientAmount']);
$reason = $_GET['reason'];

echo sendFunds($iban, $recepientIBAN, $recepientAmount, $reason, $currency);



