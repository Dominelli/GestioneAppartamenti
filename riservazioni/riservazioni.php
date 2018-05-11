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
			
			//Conferma dell'utente passato nella variabile dell'url
			$isLogged = 0;
			$isProprietario = 0;
			$username = "";
			if(isset($_SESSION["user"])) {
				$username = $_SESSION["user"];
				
				//preparo la query che verifica che l'utente inserito sia esistente
				$sql = "select username from utente where username = '".$username."'";
				if($conn->query($sql) == FALSE) {
					echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
				}
				$result = $conn->query($sql);
				//segnalo che adesso l'utente è stato confermato
				if ($result->num_rows > 0) {
					$isLogged = 1;
					
				
					//controllo che sia proprietario
					$sql = "select proprietario from utente where username = '".$username."'";
					if($conn->query($sql) == FALSE) {
						echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
					}
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							if($row["proprietario"] > 0) $isProprietario = 1;
						}
					}
				}
				
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
					
					/*echo "<pre>";
					print_r($appartamenti);
					echo "</pre>";*/
				}
				
				//Leggo le riservazioni di ogni appartamento
				for($i = 0; $i < count($appartamenti); $i++) {
					$sql = "select data_inizio,data_fine from riserva where id_appartamento = ".$appartamenti[$i][0];
					if($conn->query($sql) == FALSE) {
						echo "<p>C'è stato un errore con il tuo login</p><p>Per favore torna indietro e riprova</p>";
					}
					$result = $conn->query($sql);
					
					if ($result->num_rows > 0) {
						$riservazioni = array();
						while($row = $result->fetch_assoc()) {
							array_push($riservazioni, $row);
						}
						
						echo "<pre>";
						print_r($riservazioni);
						echo "</pre>";
					}
				}
			}
		?>
		
		<script>
		//Aggiusta l'header in base al tipo di utente
		function userHeader() {
			if(<?php echo $isLogged;?> == 0) {
				
			}
			else {
				var output = "<ul>";
				output += "Benvenuto <?php echo $username;?> ";
				if(<?php echo $isProprietario;?> == 1) output += "<a href='../aggiuntaAppartamento/AggiuntaAppartamento.htm'><li>Aggiungi appartamento</li></a>";
				output += "<a href='../index/script/logout.php'><li>Log Out</li></a>";
				output += "</ul>";
				
				document.getElementById("logInHeader").innerHTML = output;
			}
		}
		
		function addAppartamento() {
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
			
			document.getElementById("myRooms").innerHTML = output;
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
	
	
	
	<body onload="userHeader(), addAppartamento()">
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
			<form action="" method="POST">
				<table  id="myRooms">
				</table>
				
				<table>
					<tr>
						<th>Date di inizio riservazione</th>
						<th>Date di fine riservazione</th>
					</tr>
					<tr id="reservations">
					</tr>
				</table>
			
				<table>
					<tr>
						<th colspan="2">Aggiungi riservazione</th>
					</tr>
					<tr>
						<td>Da:<br><input type="date" name="fromDate" required></td>
						<td>A:<br><input type="date" name="toDate" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit" value="Aggiungi"></td>
					</tr>
				</table>
			</form>
		</main>
	</body>
</html>