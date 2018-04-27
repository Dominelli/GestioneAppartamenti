<?php
	session_start();
	if(isset($_POST['Titolo']) && isset($_POST['Paese']) && isset($_POST['Regione']) && isset($_POST['NumeroLocali']) && isset($_POST['Posteggio']) && isset($_POST['Prezzo']) && isset($_POST['SceltaPrezzo']) && isset($_POST['Spesa']) && isset($_POST['CostoSpesa']) && isset($_POST['Accessorio']) && isset($_POST['Ammobiliato']) && isset($_POST['Fumatori']) && isset($_POST['Animali']) && isset($_POST['Bambini']) && isset($_POST['Indirizzo']) && isset($_POST['Commenti'])){
		$u = $_SESSION["user"];
		$titolo = $_POST['Titolo'];
		$paese = $_POST['Paese'];
		$regione = $_POST['Regione'];
		$numeroLocali = $_POST['NumeroLocali'];
		$posteggio = $_POST['Posteggio'];
		$pianta = addslashes(file_get_contents($_FILES['Pianta']['tmp_name']));
		$foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name']));
		$prezzo = $_POST['Prezzo'];
		$sceltaPrezzo = $_POST['SceltaPrezzo'];
		$spesa = $_POST['Spesa'];
		$costoSpesa = $_POST['CostoSpesa'];
		$accessorio = $_POST['Accessorio'];
		$ammobiliato = $_POST['ammobiliato'];
		$fumatori = $_POST['fumatori'];
		$animali = $_POST['animali'];
		$bambini = $_POST['bambini'];
		$ubicazione = $_POST['Indirizzo'];
		$disponibilità = $_POST['Disponibilità'];
		$commenti = $_POST['Commenti'];
		
		$post = 0;
		$amm = 0;
		$bam = 0;
		$fum = 0;
		$anim = 0;
		if($posteggio == "Si")
			$post = 1;
		if($ammobiliato == "Si")
			$amm = 1;
		if($bambini == "Si")
			$bam = 1;
		if($fumatori == "Si")
			$fum = 1;
		if($animali == "Si")
			$anim = 1;
	  //variabili che servono a connettersi al database
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
	  //ricreo la connessione ma direttamente al database
		$conn = new mysqli($servername, $uname, $pword, $dbname);
	  //ricontrollo la connessione
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}
		//preparo la query 
	  	$sql = "select max(id) from appartamento";
		if($conn->query($sql) == FALSE) {
		  	echo "<p>C'è stato un errore con l'aggiunta del tuo appartamento</p><p>Per favore torna indietro e riprova</p>";
		}
	  	$id = $conn->query($sql) + 2;
	  //preparo la query 
	  	$sql = "INSERT INTO appartamento(id,bambini, fumatori, piantina, animali, titolo, regione, n_locali, posteggio, paese, ammobiliato, ubicazione, commenti, username_prop) VALUES 
		($id, $bam, $fum, '{$pianta}', $anim, '$titolo', '$regione', $numeroLocali, $post, '$paese', $amm, '$ubicazione', '$commenti', '$u')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO foto(foto, id_appartamento) VALUES ('{$foto}', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO accessori(nome, id_appartamento) VALUES ('$accessorio', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO prezzo(prezzo, tipo, id_appartamento) VALUES ('$prezzo', '$sceltaPrezzo', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$sql = "INSERT INTO spesa(nome, prezzo, id_appartamento) VALUES ('$spesa', '$costoSpesa', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {
		  
		}
	  //altrimenti stampo l'errore
	    else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	  //chiudo la connessione
		$conn->close();
	}
	else{
		header("Location: error.htm");
	}
?>
<body onload="redirect()">
	<p>Il tuo appartamento è stato aggiunto.</p>
	<p>Verrai reindirizzato in 3 secondi..</p>
	<script type="text/javascript">
	  //funzione che reindirizza l'utente dopo 3 secondi alla pagina principale
	  function redirect(){
		//setTimeout("window.location='http://samtinfo.ch/gestaff/index.php?username=<?php echo $u;?>'",3000);
	  }
	</script>
</body>