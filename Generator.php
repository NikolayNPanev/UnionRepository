<?php
	function GenerateIban($BANK){
		$IBAN = "BG";
		if($BANK == "BankOfKolyo"){
			$IBAN=$IBAN."01BOKB";
		}
		if($BANK == "BankOfVeni"){
			$IBAN=$IBAN."02BOVB";
		}
		for($i=0;$i<26;$i++){
			$IBAN=$IBAN.rand(0,9);
		}
		return $IBAN;
	}
?>