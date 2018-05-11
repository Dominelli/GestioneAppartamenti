<?php
	$id;
	$titolo;
	if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])){
		$id = $_GET['id'];
	}
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
	//prendo il titolo dell'appartamento corrente
	$sql = "select titolo from appartamento where id = $id";
	if($conn->query($sql) == FALSE) {
		echo "<p>C'è stato un errore con l'aggiunta del tuo appartamento</p><p>Per favore torna indietro e riprova</p>";
	}
	else{
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		  //output data of each row
			while($row = $result->fetch_assoc()) {
				$titolo = $row['titolo'];
			}
		}
	}
	//prendo le immagini dell'appartamento
	$immagini = array();					
	$sql = "select foto from foto where id_appartamento = '".$id."'";
	if($conn->query($sql) == FALSE) {
		echo "<p style='color: red;'>C'è stato un errore con la lettura delle foto</p>";
	}
	$sth = $conn->query($sql);
	if($sth->num_rows > 0){
		while($row = mysqli_fetch_array($sth)){
			array_push($immagini, base64_encode($row[0]));
		}
	}
	$sql = "select regione,n_locali,posteggio,ammobiliato,fumatori,animali,bambini from appartamento where id= '".$id."'";
	$r = $conn->query($sql);
	$prezzo;
	$tipo;
	$regione;
	$n_locali;
	$posteggio = "no";
	$ammobiliato = "no";
	$fumatori = "no";
	$animali = "no";
	$bambini = "no";
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			$regione = $row['regione'];
			$n_locali = $row['n_locali'];
			if($row['posteggio'] == 1)
				$posteggio = "si";
			if($row['ammobiliato'] == 1)
				$ammobiliato = "si";
			if($row['fumatori'] == 1)
				$fumatori = "si";
			if($row['animali'] == 1)
				$animali = "si";
			if($row['bambini'] == 1)
				$bambini = "si";
		}
	}
	$sql = "select prezzo,tipo from prezzo where id_appartamento= '".$id."'";
	$r = $conn->query($sql);
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			$prezzo = $row['prezzo'];
			$tipo = $row['tipo'];
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Visualizzazione appartamento</title>
	</head>
	<body>
		<h1><?php echo $titolo; ?></h1>
		<table>
			<tr>
				<td><div id="immagini"></div></td>
				<td><div id="info">
					<p>Prezzo: <?php echo $prezzo; echo " ".$tipo ?></p>
					<p>Regione: <?php echo $regione; ?></p>
					<p>N°locali: <?php echo $n_locali; ?></p>
					<p>Posteggio: <?php echo $posteggio; ?></p>
					<p>Ammobiliato: <?php echo $ammobiliato; ?></p>
					<p>Fumatori: <?php echo $fumatori; ?></p>
					<p>Animali: <?php echo $animali; ?></p>
					<p>Bambini: <?php echo $bambini; ?></p>
				</div></td>
			</tr>
		<script>
			var immagini = ['<?php echo implode("','",$immagini);?>'];
			var output = "";
			for(var i = 0; i < immagini.length; i++){
				if(immagini[i] != "") output += "<img src='data:image/png;base64,"+immagini[i]+"'>";
				//else output = "<img src='../index/img/default_room.png'>";
			}
			document.getElementById('immagini').innerHTML = output;
		</script>
	</body>
</html>
