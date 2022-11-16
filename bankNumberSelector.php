<?php
function BankNumber($bank){
	if($bank=="BankOfVeni"){
		return 1;
	}
	if($bank=="BankOfKolyo"){
		return 2;
	}
	return 0;
}

function getBank($bankNumber){
	if($bankNumber==1){
		return "BankOfVeni";
	}
	if($bankNumber==2){
		return "BankOfKolyo";
	}
	return 0;
	
}
?>