<?php
include('InterfaceVariables.php');

$currentDate = date('Y-m-d');
?>

<!-- <style>
div {
  width: 250px;
  height: 100px;
  border: 2px;
  background-color: powderblue;
  border: 2px solid black;
  padding: 20px;
}
table {
	text-align:  center;
	width: 250px;
}
.fullrow {
	text-align: center;
	font-weight: bold;
	color: indianred;
	font-size: 20px;
}
</style> -->
<div>
<form method='get' action='transactionHistory.php'>
	<table id='trhistoryTable'>
		<tr>
			<td class='fullrow' colspan='2'>История на транзакциите</td>
		</tr>
		<tr>
			<td> Начална дата:</td>
			<td> Крайна дата:</td>
		</tr>
		<tr>
			<td><input type='date' name='startDate'></td>
			<td><input type='date' value=<?php echo $currentDate; ?> name='endDate'></td> <!--Sets to current date-->
		</tr>
		<tr>
			<td class='fullrow' colspan='2'><button class='interfaceDouble'>Покажи</button></td>
		</tr>
	</table>
<input type="hidden" name="iban" value="<?php echo $iban;?>">
</form>
</div>

<br><a href='interface.php?iban=<?php echo $iban; ?>'><button>Връщане към основната страница</button></a>




