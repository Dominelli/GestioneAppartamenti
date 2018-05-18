<!DOCTYPE html>
<html>
	<head>
	<title>Gestione Affitti</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="Gestione, Affitti, Svizzera, Progetto, CPT, SAMT, I3AA">
		<meta name="description" content="Progetto di gestione affitti. 16.03.2018 - 18.05.2018">
		<meta name="author" content="Gabriele Dominelli">
		<meta charset="UTF-8">
		<!--[if lt IE 9]><script src="http://html5shiv.googlevode.com/svn/trunk/html5-js"></script><![endif]-->
		<link rel="stylesheet" type="text/css" href="../index/css/style.css">
		
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
			if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["roomId"])) {
				$id_appartamento = $_GET["roomId"];
				$riservazioni = array();
				
				$sql = "select data_inizio,data_fine from riserva where id_appartamento='$id_appartamento'";
				if($conn->query($sql) == FALSE) {
					echo "<p>C'è stato un errore con la riservazione</p>";
				}
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					$appartamenti = array();
					while($row = $result->fetch_assoc()) {
						$fromDate = date("d-m-Y", strtotime($row["data_inizio"]));
						$toDate = date("d-m-Y", strtotime($row["data_fine"]));
						array_push($riservazioni, array($fromDate, $toDate));
					}
				}
			}
			
			//Conferma dell'utente passato nella variabile di sessione
			$isLogged = 0;
			$isProprietario = 0;
			$username = "";
			if(isset($_SESSION["user"])) {
				$username = $_SESSION["user"];
				
				//Leggo gli appartamenti di questo utente
				$sql = "select id,titolo from appartamento where username_prop = '".$username."'";
				if($conn->query($sql) == FALSE) {
					echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
				}
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					$appartamenti = array();
					while($row = $result->fetch_assoc()) {
						array_push($appartamenti, $row);
					}
				}
			}
		?>
		
		<script>
		
		//Aggiunge gli appartamenti dell'ultente con i loro radio button
		function addAppartamenti() {
			var appartamenti = [<?php for($i = 0; $i < count($appartamenti); $i++) {
				echo "['";
				echo implode("','",$appartamenti[$i]);
				echo "']";
				if($i < count($appartamenti)-1) echo ",";
			}?>];
			
			var output = "";
			output = "<tr><th>I miei appartamenti</th><th>Selezione</th></tr>";
			for(var i = 0; i < appartamenti.length; i++) {
				output += "<tr>";
				output += "<td>"+appartamenti[i][1]+"</td>";
				output += "<td><input type='radio' name='roomId' value='"+appartamenti[i][0]+"' required></td>";
				output += "</tr>";
			}
			output += "<tr><td colspan='2'><input type='submit' value='Cerca riservazioni'></td></tr>";
			
			document.getElementById("myRooms").innerHTML = output;
		}
		
		//mostra le riservazioni
		function showRiservazioni() {
			var riservazioni = [<?php for($i = 0; $i < count($riservazioni); $i++) {
				echo "['";
				echo implode("','",$riservazioni[$i]);
				echo "']";
				if($i < count($riservazioni)-1) echo ",";
			}?>];
			var id_appartamento = <?php echo $id_appartamento; ?>;
			
			var output = "";
			for(var i = 0; i < riservazioni.length; i++) {
				output += "<tr>";
				output += "<td>"+riservazioni[i][0]+"</td>";
				output += "<td>"+riservazioni[i][1]+"</td>";
				output += "</tr>";
			}
			
			document.getElementById("reservations").innerHTML += output;
			document.getElementById("id").value = id_appartamento;
			
			var radioButtons = document.getElementsByName("roomId");
			for(var i = 0; i < radioButtons.length; i++) {
				console.log(id_appartamento);
				if(radioButtons[i].value == id_appartamento) document.getElementsByName("roomId")[i].checked = true;
			}
		}
		</script>
		
		<style>
			main table {
				margin: 30px auto;
				border: solid 1px black;
				border-radius: 5px;
				background-color: white;
				box-shadow: 0px 0px 10px 3px rgba(0,0,0,0.2);
				padding: 10px;
			}
			main table td {
				text-align: center;
				padding: 10px;
				margin: 5px 0px;
			}
			main table th {
				border-bottom: solid 1px black;
				padding: 10px;
				margin: 5px 0px;
			}
		</style>
	</head>
	
	
	
	<body onload="addAppartamenti(), showRiservazioni()">
		<header>
			<div id="logInHeader"></div>
			<table>
				<tr>
					<td><a href="../index.php"><img src="../index/img/home.png" width="25px" height="25px"></a></td>
					<td><a href="../index.php"><h1>Affittamenti.ch</h1></a></td>
				</tr>
			</table>
		</header>
		
		<main>
			<form action="" method="GET">
				<table id="myRooms">
				</table>
			</form>
			
			<table id="reservations">
				<tr>
					<th>Date di inizio riservazione</th>
					<th>Date di fine riservazione</th>
				</tr>
			</table>
			
			<form action="aggiungiRiservazione.php" method="POST">
				<table>
					<tr>
						<th colspan="3">Aggiungi riservazione</th>
					</tr>
					<tr>
						<td>Da:<br><input type="date" name="fromDate" required></td>
						<td>A:<br><input type="date" name="toDate" required></td>
						<input type="text" name="user" value="<?php echo $username; ?>" style="display: none;">
						<input type="number" name="id" id="id" style="display: none;">
					</tr>
					<tr>
						<td colspan="3"><input type="submit" value="Aggiungi"></td>
					</tr>
				</table>
			</form>
		</main>
		
		
		<footer>
			&#169 2018 Gabriele Dominelli I3AA, Alessandro Spagnuolo I3BB
		</footer>
	</body>
</html>