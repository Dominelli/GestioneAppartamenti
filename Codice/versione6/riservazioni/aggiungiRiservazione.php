<?php
	session_start();
	global $id_appartamento;
	$id_appartamento = 0;
	
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
	
	//Dopo che l'utente ne effettua la ricerca, carico le date riservate di un appartamento
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fromDate"]) && isset($_POST["toDate"]) && isset($_POST["user"])) {
		$fromDate = date("Y-m-d",strtotime($_POST["fromDate"]));
		$toDate = date("Y-m-d",strtotime($_POST["toDate"]));
		$id = $_POST["id"];
		$user = $_POST["user"];
		
		//echo "insert into riserva (data_inizio, data_fine, id_appartamento, username_utente) values ('$fromDate', '$toDate', $id, '$user')";
		
		$sql = "insert into riserva(data_inizio, data_fine, id_appartamento, username_utente) values ('$fromDate', '$toDate', $id, '$user')";
		if($conn->query($sql) == FALSE) echo "<br>Errore";
		
		$conn->close();
	}
	
	header("Location: riservazioni.php");
?>