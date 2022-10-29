<?php
	function GenerateIban($BANK){
		//All Bulgarian IBANS start with BG -- +2characters
		$IBAN = "BG";
		//Controll number and letters for Bank of Kolyo -- +6characters
		if($BANK == "BankOfKolyo"){
			$IBAN=$IBAN."01BOKB";
		}
		//Controll number and letters for Bank of Veni -- +6characters
		if($BANK == "BankOfVeni"){
			$IBAN=$IBAN."02BOVB";
		}
		//26 Randomly Generated Numbers -- +26characters
		for($i=0;$i<26;$i++){
			$IBAN=$IBAN.rand(0,9);
		}

		//total characters on a successfully created IBAN:
		//34
		return $IBAN;

		//Total characters on a failed IBAN:
		//28 (Neither of the banks is selected and the IBAN is generated invalidly)
	}

