<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["period"])) {
			$fromDate = $_POST["fromDate"];
			$toDate = $_POST["toDate"];
		}
		$price = $_POST["price"];
		$n_locali = $_POST["rooms_number"];
		
		//echo "$fromDate, $toDate, $price, $n_locali";
		
		//preparo le variabili per la connessione al database
		$dbname = "efof_gestaff_2018";
		$servername = "efof.myd.infomaniak.com";
		$uname = "efof_gestaff2018";
		$pword = "GestAff_Admin2018";
		//creo una connessione
		$conn = new mysqli($servername, $uname, $pword);
		//controllo la connessione
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		//ricreo la connessione direttamente al database
		$conn = new mysqli($servername, $uname, $pword, $dbname);
		//ricontrollo la connessione
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		
	}
?>