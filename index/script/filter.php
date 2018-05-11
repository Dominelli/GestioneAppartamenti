<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		session_start();
		
		if(isset($_POST["period"])) {
			$fromDate = $_POST["fromDate"];
			$toDate = $_POST["toDate"];
		}
		
		$price = $_POST["price"];
		$n_locali = $_POST["rooms_number"];
		
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
		
		//Lettura degli appartamenti dal DB in base ai campi inseriti
		$sql_appartamenti = "select a.id,a.titolo,a.n_locali,a.commenti from appartamento a join prezzo p on p.id_appartamento = a.id where p.prezzo <= $price && a.n_locali = $n_locali order by id desc limit 6";
		$appartamenti = array();
		if($conn->query($sql_appartamenti) == FALSE) {
			echo "<p>C'è stato un errore con la lettura degli appartamenti</p><p>Per favore torna indietro e riprova</p>";
		}
		$result = $conn->query($sql_appartamenti);
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				array_push($appartamenti, $row);
			}
		}
		
		//Lettura dei prezzi dal DB in base ai campi inseriti
		$sql_prezzi = "select p.prezzo,p.tipo from prezzp p join appartamento a on p.id_appartamento = a.id where p.prezzo <= $price && a.n_locali = $n_locali order by id desc limit 6";
		$prezzi = array();
		for($i = 0; $i < count($appartamenti); $i++) {
			
			$id_appartamento = $appartamenti[$i]["id"];
			$sql = "select prezzo,tipo from prezzo where id_appartamento = ".$id_appartamento;
		
			if($conn->query($sql) == FALSE) {
				echo "<p style='color: red;'>C'è stato un errore con la lettura dei prezzi</p>";
			}
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($prezzi, $row);
				}
			}
		}
		
		//Leggo le immagini degli appartamenti
		$immagini = array();
		for($i = 0; $i < count($appartamenti); $i++) {
			
			$id_appartamento = $appartamenti[$i]["id"];
			$sql = "select foto from foto where id_appartamento = '".$id_appartamento."' order by id_appartamento asc limit 1";
		
			if($conn->query($sql) == FALSE) {
				echo "<p style='color: red;'>C'è stato un errore con la lettura delle foto</p>";
			}
			$sth = $conn->query($sql);
			$result = mysqli_fetch_array($sth);
			
			if(result[0] != null) array_push($immagini,array($id_appartamento, base64_encode($result[0])));
		}
		
		$_SESSION["appartamenti"] = $appartamenti;
		$_SESSION["prezzi"] = $prezzi;
		$_SESSION["immagini"] = $immagini;
		
		header("Location: ../../index.php");
	}
?>