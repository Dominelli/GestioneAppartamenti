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
	$sql = "select regione,n_locali,posteggio,ammobiliato,fumatori,animali,bambini,commenti,ubicazione,username_prop from appartamento where id= '".$id."'";
	$r = $conn->query($sql);
	$prezzo;
	$tipo;
	$regione;
	$commenti;
	$n_locali;
	$posteggio = "no";
	$ammobiliato = "no";
	$fumatori = "no";
	$animali = "no";
	$bambini = "no";
	$indirizzo;
	$u_prop;
	$u_nome;
	$u_cognome;
	$u_cellulare;
	$u_email;
	$prezzoSpesa = array();
	$nomeSpesa = array();
	$accessori = array();
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			$regione = $row['regione'];
			$n_locali = $row['n_locali'];
			$commenti = $row['commenti'];
			$indirizzo = $row['ubicazione'];
			$u_prop = $row['username_prop'];
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
	$piantina;
	$sql = "select piantina from appartamento where id = '".$id."'";
	$r = $conn->query($sql);
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			$piantina = base64_encode($row['piantina']);
		}
	}
	$sql = "select nome,cognome,n_cellulare,email from utente where username = '".$u_prop."'";
	$r = $conn->query($sql);
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			$u_nome = $row['nome'];
			$u_cognome = $row['cognome'];
			$u_cellulare = $row['n_cellulare'];
			$u_email = $row['email'];
		}
	}
	$sql = "select nome, prezzo from spesa where id_appartamento= '".$id."'";
	$r = $conn->query($sql);
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			array_push($nomeSpesa,$row['nome']);
			array_push($prezzoSpesa,$row['prezzo']);
		}
	}
	$sql = "select nome from accessori where id_appartamento= '".$id."'";
	$r = $conn->query($sql);
	if ($r->num_rows > 0) {
	  //output data of each row
		while($row = $r->fetch_assoc()) {
			array_push($accessori,$row['nome']);
		}
	}
	
	//Controllo che l'utente in questa pagina sia registrato
	session_start();
	global $isLogged;
	$isLogged = 0;
	if(isset($_SESSION["user"]) && $_SESSION["user"] != "") {
		$isLogged = 1;
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="Gestione, Affitti, Svizzera, Progetto, CPT, SAMT, I3BB">
	<meta name="description" content="Progetto di gestione affitti. 16.03.2018 - 18.05.2018">
	<meta name="author" content="Alessandro Spagnuoolo">
	<meta charset="UTF-8">
	<!--[if lt IE 9]><script src="http://html5shiv.googlevode.com/svn/trunk/html5-js"></script><![endif]-->
		<title>Visualizzazione appartamento</title>
		<style>
			
			/* GENERALE */
			body {
				margin: 0px;
			}
			header a {
				text-decoration: none;
				color:white;
			}
			
			/* HEADER */
			header h1, header img{
				padding: 0px;
				margin: 0px;
			}
			header {
				border: solid 1px white;
				margin: 0px;
				padding: 0px 10px;
				background-color: rgb(255,168,52);
				color: white;
			}
			header ul {
				list-style-type: none;
				margin: 0px;
				margin-top: 12px;
				padding: 0px;
				float: right;
			}
			header li {
				display: inline;
				background-color: rgb(255,255,255);
				color: black;
				padding: 5px;
				border-radius: 4px;
			}
			header li:hover {
				background-color: rgb(255,221,174);
			}
			header li:active {
				background-color: rgb(255,221,174);
			}
			
			/* FOOTER */
			footer {
				text-align: center;
				border: solid 1px white;
				padding: 10px 10px;
				background-color: rgb(255,168,52);
				color: white;
			}
			
			/*CORPO CENTRALE */
			#main{
				border: solid 1px black;
				border-radius: 5px;
				background-color: rgb(240,240,240);
				box-shadow: 0px 0px 10px 3px rgba(0,0,0,0.2);
				padding: 10px;
				margin: 50px auto;
			}
			div{
				border: solid 1px black;
				border-radius: 5px;
				background-color: white;
				box-shadow: 0px 0px 10px 3px rgba(0,0,0,0.2);
				padding: 10px;
				min-height: 20px;
			}
			#main td{
				padding: 10px;
			}
		</style>
	</head>
	<body onload="showContatto()">
	<header id="header">
			<ul>
				
			</ul>
			<table>
				<tr>
				<td><a href="../index.php"><img src="../index/img/home.png" width="25px" height="25px"></a></td>
				<td><a href="../index.php"><h1>Affittamenti.ch</h1></a></td>
				</tr>
			</table>
		</header>
		<table id="main">
			<tr><td><h1 style="font-size="40px"><?php echo $titolo; ?></h1></td></tr>
			<tr>
				<td>
					<div id="immagini" style="background-color: white; text-align: center;"></div>
					<button onclick="allImages()">Altre Immagini</button><span id="noImg" hidden>Non ci sono altre immagini</span>
				</td>
				<td><div id="info">
					<p>Prezzo: <?php echo $prezzo; echo ".- / ".$tipo ?></p>
					<p>Regione: <?php echo $regione; ?></p>
					<p>Indirizzo: <?php echo $indirizzo ?></p>
					<p>N°locali: <?php echo $n_locali; ?></p>
					<p>Posteggio: <?php echo $posteggio; ?></p>
					<p>Ammobiliato: <?php echo $ammobiliato; ?></p>
					<p>Fumatori: <?php echo $fumatori; ?></p>
					<p>Animali: <?php echo $animali; ?></p>
					<p>Bambini: <?php echo $bambini; ?></p>
				</div></td>
			</tr>
			<tr>
				<td><div id="piantina">Piantina: <img src="data:image/png;base64,<?php echo $piantina; ?>" style="padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;"></div></td>
				<td><div>Commenti: <br> <?php echo $commenti; ?></div></td>
			</tr>
			<tr>
				<td>Spese:<div id="spese"></div></td>
				<td>Accessori:<div id="accessori"></div></td>
			</tr>
			<tr id="contacts" hidden>
				<td><div id="contatto">Contatto: <?php echo $u_nome." ".$u_cognome; ?></div></td>
				<td><div>
					<p>N°Cellulare: <?php echo $u_cellulare; ?></p>
					<p>E-Mail: <?php echo $u_email; ?></p>
				</div></td>
			</tr>
			<tr>
				<td><div id="all" hidden style="background-color: white; text-align: center;"></div></td>
			</tr>
		</table>
		<script>
			var piantina = '<?php echo $piantina; ?>';
			var immagini = ['<?php echo implode("','",$immagini);?>'];
			var accessori = ['<?php echo implode("','",$accessori);?>'];
			var nomeSpese = ['<?php echo implode("','",$nomeSpesa);?>'];
			var prezzoSpese = ['<?php echo implode("','",$prezzoSpesa);?>'];
			var output = "";
			var images = "";
			for(var i = 0; i < immagini.length; i++){
				if(immagini[i] != ""){
					output = "<img src='data:image/png;base64,"+immagini[0]+"' style='padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;'>";
					images += "<img src='data:image/png;base64,"+immagini[i]+"' style='padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;'>";
				}
				else output = "<img src='../index/img/default_room.png'>";
			}
			if(piantina == 'bnVsbA==')
				document.getElementById('piantina').innerHTML = "<img src='../index/img/default_room.png'>";
			document.getElementById('immagini').innerHTML = output;
			for(var i = 0; i < accessori.length; i++){
				document.getElementById("accessori").innerHTML += "<span>"+accessori[i]+"</span><br>";
			}
			for(var i = 0; i < nomeSpese.length; i++){
				if(nomeSpese[i] != "")document.getElementById("spese").innerHTML += "<span>"+nomeSpese[i]+" </span><span>" +prezzoSpese[i]+".-</span><br>";
			}
			function allImages(){
				if(immagini.length > 1){
					document.getElementById("all").hidden = false;
					document.getElementById("all").innerHTML = images;
				}
				else{
					document.getElementById("noImg").hidden = false;
				}
			}
			
			function showContatto() {
				var isLogged = <?php echo $isLogged; ?>;
				if(isLogged == 1) document.getElementById("contacts").hidden = false;
			}
		</script>
		<footer id="footer">
		&#169 2018 Gabriele Dominelli I3AA, Alessandro Spagnuolo I3BB
		</footer>
	</body>
</html>
