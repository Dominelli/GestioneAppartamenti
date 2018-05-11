<?php
	session_start();
  //controllo che l'utente abbia inserito correttamente i campi di login
	if(isset($_POST['Username']) && $_POST['Username'] != "" && isset($_POST['Password']) && $_POST['Password'] != ""){
	  //prendo i valori dell'utente
	    $username = $_POST['Username'];
		$password = $_POST['Password'];
	  
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
		
	  	$user = array();
	  	$valore = array();
	  	array_push($user, $username);
	  //preparo la query che verifica che l'utente inserito sia esistente
	  	$sql = "select username from utente where username = '".$username."' and password = '".$password."' and stato = 1";
		if($conn->query($sql) == FALSE) {
		  	echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
		}
	  	$result = $conn->query($sql);
	  
	  	if ($result->num_rows > 0) {
		  //output data of each row
			while($row = $result->fetch_assoc()) {
		  		array_push($valore, $row["username"]);
			}
	  	}
	  	if($valore[0] == $user[0]){
		  //reindirizzo l'utente alla pagina principale con il suo login
		  	$_SESSION['user'] = $user[0];
		  	header("Location: ../index.php");
		}
		else{
		  echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
		}
	  //chiudo la connessione
		$conn->close();
	}
	else{
	  echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
	}
?>