<?php
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
  //prendo l'username dell'utente che bisogna confermare dal get nell'url
	if(isset($_GET['username'])){
		$u = $_GET['username'];
	  //cambio lo stato di quell'utente da "non confermato" a "confermato"
	  	$sql = "update utente set stato = 1 where username = '".$u."'";
	  //controllo che la query vada a buon fine
		if ($conn->query($sql) === TRUE) {
			
		} 
	  //altrimenti stampo l'errore
	  	else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	  //chiudo la connessione
		$conn->close();
	}
?>
<body onload="redirect()">
<p>Il tuo account è stato confermato.</p>
<p>Verrai reindirizzato in 3 secondi..</p>
<script type="text/javascript">
  //funzione che reindirizza l'utente dopo 3 secondi alla pagina principale
  function redirect(){
	setTimeout("window.location='http://samtinfo.ch/gestaff/index.php?username=<?php echo $u;?>'",3000);
  }
</script>
</body>