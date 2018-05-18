<?php
  //controllo che tutti i campi siano stati immessi dall'utente
	if(isset($_POST['Name']) && $_POST['Name'] != "" && isset($_POST['Surname']) && $_POST['Surname'] != "" && isset($_POST['Password']) && $_POST['Password'] != "" && isset($_POST['Username']) && $_POST['Username'] != "" && isset($_POST['Address']) && $_POST['Address'] != "" && isset($_POST['Tel_Phone']) && $_POST['Tel_Phone'] != "" && isset($_POST['Tel_Office']) && $_POST['Tel_Office'] != "" && isset($_POST['Email_Address']) && $_POST['Email_Address'] != ""){
	  //prendo i valori dell'utente e li salvo dentro le variabili di seguito
	    $name = $_POST['Name'];
		$surname = $_POST['Surname'];
		$username = $_POST['Username'];
		$email = $_POST['Email_Address'];
		$password = $_POST['Password'];
		$address = $_POST['Address'];
		$tel_office = $_POST['Tel_Office'];
		$tel_phone = $_POST['Tel_Phone'];
	  	
	  //dichiaro le variabili che indicano come connettersi al database
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
	  //ricreo la connessione ma con il database
		$conn = new mysqli($servername, $uname, $pword, $dbname);
	  //Ricontrollo la connessione
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		} 
	  //preparo la query che inserisce l'utente che si vuole registrare
	  	$sql = "INSERT INTO utente VALUES ('$name', '$surname', '$username', '$email', '$password', '$tel_phone', '$tel_office', 0, 0, 0)";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	  //chiudo la connessione
		$conn->close();

	  //preparo le variabili che servono a mandare l'email di conferma all'utente
		$to = $email;
		$subject = "Confirm registration";
	    $txt = 
		  "Ciao ".$username."! Grazie per la registrazione!".
		  " Clicca il link di seguito per completare la verifica del tuo account".
		  "<br><a href='http://samtinfo.ch/gestaff/registrazione/email_verification.php?username=".$username."'>clicca qui</a>"
		  ;
		$headers =  'MIME-Version: 1.0' . "\r\n"; 
		$headers .= 'From: WebMaster <webmaster@affitamenti.ch>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	  //invio l'email
		mail($to,$subject,$txt, $headers);
		
	  //reindirizzo l'utente alla pagina seguente
	  	header("Location: thankyou.htm");
	  	
	}
  //se anche un solo campo non è stato riempito correttamente
  //reindirizzo l'utente alla pagina seguente
	else{
		header("Location: error.htm");
	}
?>

