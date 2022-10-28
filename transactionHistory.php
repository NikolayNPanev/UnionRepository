<?php

echo "ayo mister white, welcome to the transaction history, bitch";
?>
<style>
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
</style>
<div>
	<table>
		<tr><td class="fullrow" colspan="2">Transaction history</td></tr>
		<tr>
			<td> Start date:</td>
			<td> End date:</td>
		</tr>
		<tr>
			<td><input type="date"></td>
			<td><input type="date" value=<?php echo date('Y-m-d'); ?>></td> <!--Sets to current date-->
		</tr>
		<tr>
			<td class="fullrow" colspan="2"><button>GO</button></td>
		</tr>
	</table>
</div>

<br><a href="interface.php"><button>Return to Main Page</button></a>


