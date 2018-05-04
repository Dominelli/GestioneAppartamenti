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
		<link rel="stylesheet" type="text/css" href="index/css/style.css">
		<link rel="stylesheet" type="text/css" href="index/css/responsive.css">
		
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
			}
			
			//Leggo gli ultimi 6 appartamenti
			global $appartamenti;
			$appartamenti = array();
			//preparo la query che verifica che l'utente inserito sia esistente
			$sql = "SELECT id,titolo,n_locali,commenti from appartamento order by id desc limit 6";
			if($conn->query($sql) == FALSE) {
				echo "<p>C'è stato un errore con la lettura degli appartamenti</p><p>Per favore torna indietro e riprova</p>";
			}
			$result = $conn->query($sql);
			
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					array_push($appartamenti, $row);
				}
			
				//Leggo il prezzo degli appartamenti
				global $prezzi;
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
				global $immagini;
				$immagini = array();
				for($i = 0; $i < count($appartamenti); $i++) {
					
					$id_appartamento = $appartamenti[$i]["id"];
					$sql = "select foto from foto where id_appartamento = '".$id_appartamento."' order by id_appartamento asc limit 1";
				
					if($conn->query($sql) == FALSE) {
						echo "<p style='color: red;'>C'è stato un errore con la lettura delle foto</p>";
					}
					$sth = $conn->query($sql);
					$result = mysqli_fetch_array($sth);
					
					array_push($immagini, array($id_appartamento, base64_encode($result[0])));
				}
			}
			
		?>
		
		<script>
			//Aggiusta l'header in base al tipo di utente
			function userHeader() {
				if(<?php echo $isLogged;?> == 0) {
					document.getElementById("logInHeader").innerHTML = "<ul><a href='registrazione/Registrazione.htm'><li>Registrati</li></a><a href='login/Login.htm'><li>Accedi</li></a></ul>";
				}
				else {
					var output = "<ul>";
					if(<?php echo $isProprietario;?> == 1) output += "<a href='aggiuntaAppartamento/AggiuntaAppartamento.htm'><li>Aggiungi appartamento</li></a>";				
					output += "Benvenuto <?php echo $username;?> ";
					output += "<a href='index/script/logout.php'><li>Log Out</li></a>";
					output += "</ul>";
					
					document.getElementById("logInHeader").innerHTML = output;
				}
			}
			
			//Attivazione dei campi data nei filtri di ricerca
			function switchPeriod() {
				var periodCheckBox = document.getElementsByName("period")[0];
				var periodDates = document.getElementById("periodDates");
				var fromDate = document.getElementsByName("fromDate")[0];
				var toDate = document.getElementsByName("toDate")[0];
				
				//Quando il checkbox è true, abilità i campi date.
				//Se false li disabilita
				if(periodCheckBox.checked) {
					fromDate.disabled = false;
					toDate.disabled = false;
				}
				else {
					fromDate.disabled = true;
					toDate.disabled = true;
				}
			}
			
			//Scrive il valore dell'input range del prezzo nei filtri di ricerca
			function displayPricePreview() {
				var value = document.getElementsByName("price")[0].value;
				document.getElementById("pricePreview").innerHTML = value+" CHF";
			}
			
			//visualizzazone degli appartamenti
			function showRooms(){
				var appartamenti = [<?php for($i = 0; $i < count($appartamenti); $i++) {
					echo "['";
					echo implode("','",$appartamenti[$i]);
					echo "']";
					if($i < count($appartamenti)-1) echo ",";
				}?>];
				var prezzi = [<?php for($i = 0; $i < count($prezzi); $i++) {
					echo "['";
					echo implode("','",$prezzi[$i]);
					echo "']";
					if($i < count($prezzi)-1) echo ",";
				}?>];
				var immagini = [<?php for($i = 0; $i < count($immagini); $i++) {
					echo "['";
					echo implode("','",$immagini[$i]);
					echo "']";
					if($i < count($immagini)-1) echo ",";
				}?>];
				
				var output = "";
				var lastRoom = document.getElementById("ultimoAnnuncio");
				var otherRooms = document.getElementById("altriAnnunci");
				
				//Aggiorno l'ultimo ed il resto degli annunci
				for(var i = 0; i < appartamenti.length; i++) {
					output = "<a href='appartamento/appartamento.php?id="+immagini[i][0]+"'>";
					
					if(i == 0) output += "<section id='lastRoom' class='room'>";
					else output += "<section class='room'>"
					
					output += "<table><tr><td>"+appartamenti[i][1]+"</td>";
					output += "<td>"+prezzi[i][0]+".- / "+prezzi[i][1]+"</td>";
					output += "<td>"+appartamenti[i][2]+" locali</td>";
					
					if(immagini[i][1] != "") output += "<td rowspan='2'><img src='data:image/png;base64,"+immagini[i][1]+"' class='roomImg'></td>";
					else output += "<td rowspan='2'><img src='index/img/default_room.png' class='roomImg'></td>";
					
					output += "</tr><tr>";
					output += "<td colspan='3'>Descrizione<br>"+appartamenti[i][3]+"</td>";
					output += "</tr></table></section></a>";
					
					if(i == 0) document.getElementById("ultimoAnnuncio").innerHTML = output;
					else document.getElementById("altriAnnunci").innerHTML += output;
				}
			}
		</script>
	</head>
	
	<body onload="displayPricePreview(), userHeader(), showRooms()">
		<header>
			<div id="logInHeader">
				<!--<ul>
					<a href="registrazione/Registrazione.htm"><li>Registrati</li></a>
					<a href="login/Login.htm"><li>Accedi</li></a>
				</ul>-->
			</div>
			<table>
				<tr>
					<td><a href="#"><img src="index/img/home.png" width="25px" height="25px"></a></td>
					<td><a href="#"><h1>Affittamenti.ch</h1></a></td>
				</tr>
			</table>
		</header>
		
		<table id="center">
			<tr>
				<td>
				<div id="navMenu">
					<nav class="sidebar" id="filters">
						<h3>Filtri di ricerca</h3>
		
						<form action="index/script/filter.php" method="POST">
							<table>
								<tr>
									<td><img src="index/img/clock.png" width="20px" height="20px"></td>
									<td><input type="checkbox" name="period" onchange="switchPeriod()"></input>Periodo<br><br></td>
								</tr>
								<tr id="periodDates">
									<td></td>
									<td>
										Da:<br>
										<input type="date" class="navInput" name="fromDate" disabled></input><br>
										A:<br>
										<input type="date" class="navInput" name="toDate" disabled></input><br><br>
									</td>
								</tr>
								<tr>
									<td><img src="index/img/rooms.png" width="20px" height="20px"></td>
									<td>Numero locali:<br>
										<select name="rooms_number" class="navInput">
											<option value="1">1</option>
											<option value="1.5">1.5</option>
											<option value="2">2</option>
											<option value="2.5">2.5</option>
											<option value="3">3</option>
											<option value="3.5">3.5</option>
											<option value="4">4</option>
											<option value="4.5">4.5</option>
											<option value="5">5</option>
											<option value="5.5">5.5</option>
											<option value="6">6</option>
											<option value="6.5">6.5</option>
											<option value="7">7</option>
											<option value="7.5">7.5</option>
											<option value="8">8</option>
										</select><br><br>
									</td>
								</tr>
								<tr>
									<td><img src="index/img/money.png" width="20px" height="20px"></td>
									<td>Prezzo: <span id="pricePreview"></span><br><br>
										<input type="range" class="navInput" step="100" min="100" max="5000" name="price" onchange="displayPricePreview(this)"></input><br>
										100 CHF &#10140 5'000 CHF
									</td>
								</tr>
								<tr>
									<td></td>
									<td><br><input type="submit" value="Cerca"></input></td>
								</tr>
							</table>
						</form>
					</nav>
					
					<section class="sidebar" id="description">
						<h3>Gestione Appartamenti</h3>
						
						<u>Partecipanti:</u><br>
						<ul>
							<li>Gabriele Dominelli</li>
							<li>Alessandro Spagnuolo</li>
						</ul>
						
						<br>
						
						<u>Docente responsabile:</u><br>
						<ul>
							<li>Massimo Sartori</li>
						</ul>
						
						<br>
						
						<u>Descrizione del progetto:</u>
						<p>
							Questo progetto consiste nell'implementazione di un'applicazione web che permetta di gestire l'affitto di appartamenti in Svizzera.<br><br>
							Il progetto completo verrà presentato principalmente a un pubblico potenzialmente senza conoscenze informatiche.<br><br>
							Le interfaccie e le funzionalità dovranno essere intuitive e seguiranno gli standard dei siti di fama più alta.
						</p>
					</section>
				</div>
				</td>
				
				<td style="width: 100%;">
				<main id="main">
					<h3>Ultimo Annuncio</h3>
					<div id="ultimoAnnuncio">
						<!--<a href="#">
							<section id="lastRoom" class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>-->
					</div>
					<hr>
					<h3>Altri Annunci</h3>
					<div id="altriAnnunci">
						<!--<a href="#">
							<section class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>
						
						<a href="#">
							<section class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>
						
						<a href="#">
							<section class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>
						
						<a href="#">
							<section class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>
						
						<a href="#">
							<section class="room">
								<table>
									<tr>
										<td>TITOLO</td>
										<td>CHF / mese</td>
										<td>No. locali</td>
										<td rowspan="2">
											<img src="index/img/default_room.png" class="roomImg">
										</td>
									</tr>
									<tr>
										<td colspan="3">
										Descrizione:<br>
										Sono un annuncio
										</td>
									</tr>
								</table>
							</section>
						</a>-->
					</div>
				</main>
				</td>
			</tr>
		</table>
		
		<footer>
			&#169 2018 Gabriele Dominelli I3AA, Alessandro Spagnuolo I3BB
		</footer>
	</body>
</html>