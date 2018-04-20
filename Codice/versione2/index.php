<!DOCTYPE html>
<html>
	<head>
		<title>Gestione Affitti</title>
	</head>
	
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
		
		/* LEFT SIDEBAR */
		#navMenu {
			margin: 10px;
			width: 20vw;
		}
		#navMenu h3 {
			margin-top: 0px;
		}
		.sidebar {
			background-color: rgba(230,230,230,0.5);
			padding: 10px;
			margin-bottom: 10px;
			border-radius: 4px;
		}
		.sidebar td {
			vertical-align: middle;
		}
		.sidebar img {
			padding-right: 5px;
		}
		.navInput {
			width: 10vw;
		}
		#periodDates input:disabled {
			background: #dddddd;
			color: #dddddd;
		}
		#periodDates input:enabled {
			background: white;
		}
		
		/* CORPO CENTRALE */
		main {
			margin-right: 10px;
			width: 100%;
		}
		main a {
			text-decoration: none;
			color: black;
		}
		.room {
			border-radius: 7px;
			padding-left: 10px;
			padding-bottom: 10px;
			margin-bottom: 10px;
			background-color: rgba(230,230,230,0.3);
		}
		.room table{
			margin: auto;
			width: 100%;
			table-layout: fixed;
		}
		.room td {
			width: auto;
		}
		.room img {
			float: right;
			vertical-align: middle;
			padding: 0px;
			margin: 0px;
			width: 10vw;
			height: 10vw;
		}
		.room:hover {
			background-color: rgba(255,199,123,0.3);
		}
		#lastRoom {
			background-color: rgba(255,168,52,0.3);
		}
		#lastRoom:hover {
			background-color: rgba(255,199,123,0.3);
		}
		
		/* CORPO CENTRALE + LEFT SIDEBAR */
		#center td {
			vertical-align: top;
			padding: 0px;
		}
		
		/* FOOTER */
		footer {
			text-align: center;
			border: solid 1px white;
			padding: 10px 10px;
			background-color: rgb(255,168,52);
			color: white;
		}
		
		/* AGGIUSTAMENTO RESPONSIVE VERTICALE */
		@media screen and (max-width: 785px) {
			main {
				margin: 0px;
			}
			#description {
				display: none;
			}
			#navMenu {
				width: 100%;
				margin: 0px;
			}
			.sidebar table {
				margin:auto;
			}
			.sidebar input {
				width: auto;
			}
			.sidebar tr{
				display: inline-table;
				padding: 10px;
			}
			.sidebar td {
				padding: 0px;
				width: 100%;
			}
			#center td {
				display: block;
				padding: 0px;
			}
			#center {
				margin: 10px;
			}
			.room img {
				float: none;
			}
			.room tr{
				text-align: center;
			}
		}
	</style>
	
	<script>
		//funzione per rendere la pagina responsive
		function resize() {
			var w = window.innerWidth;
			
			if(w > 785) {
				
				//Imposta la larghezza del menu laterale
				var navW = w/100 * 20;
				document.getElementById("navMenu").style.width = navW+"px";
				
				//Imposto la larghezza dei campi input nel menu laterale
				var navInputs = document.getElementsByClassName("navInput");
				for(var i = 0; i < navInputs.length; i++) {
					navInputs[i].style.width = (navW * 0.5)+"px";
				}
				
				//Imposta il margine sinistro del corpo centrale
				//document.getElementById("main").style.marginLeft = (navW+10*2)+"px";
				
				//Imposta le grandezze delle immagini degli annunci
				var roomImgs = document.getElementsByClassName("roomImg");
				var mainW = w-(navW+10*3);
				for(var i = 0; i < roomImgs.length; i++) {
					roomImgs[i].width = mainW/8;
				}
			}
		}
		//setInterval(resize, 500);
		
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
		
		function displayPricePreview() {
			var value = document.getElementsByName("price")[0].value;
			document.getElementById("pricePreview").innerHTML = value+" CHF";
		}
	</script>
	
	<body onload="displayPricePreview()">
		<header>
			<ul>
				<a href="#"><li>Registrati</li></a>
				<a href="#"><li>Accedi</li></a>
			</ul>
			<table>
				<tr>
					<td><a href="#"><img src="Index/img/home.png" width="25px" height="25px"></a></td>
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
		
						<form action="" method="POST">
							<table>
								<tr>
									<td><img src="Index/img/clock.png" width="20px" height="20px"></td>
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
									<td><img src="Index/img/rooms.png" width="20px" height="20px"></td>
									<td>Numero locali:<br>
										<select name="rooms_number" class="navInput">
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
									<td><img src="Index/img/money.png" width="20px" height="20px"></td>
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
					<a href="#">
						<section id="lastRoom" class="room">
							<table>
								<tr>
									<td>TITOLO</td>
									<td>CHF / mese</td>
									<td>No. locali</td>
									<td>
										<img src="Index/img/default_room.png" class="roomImg">
									</td>
								</tr>
								<tr>
									<td>
									Descrizione:<br>
									Sono un annuncio
									</td>
								</tr>
							</table>
						</section>
					</a>
					<hr>
					<h3>Altri Annunci</h3>
					<a href="#">
						<section class="room">
							<table>
								<tr>
									<td>TITOLO</td>
									<td>CHF / mese</td>
									<td>No. locali</td>
									<td rowspan="2">
										<img src="Index/img/default_room.png" class="roomImg">
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
										<img src="Index/img/default_room.png" class="roomImg">
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
										<img src="Index/img/default_room.png" class="roomImg">
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
										<img src="Index/img/default_room.png" class="roomImg">
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
										<img src="Index/img/default_room.png" class="roomImg">
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
				</main>
				</td>
			</tr>
		</table>
		
		<footer>
			&#169 2018 Gabriele Dominelli I3AA, Alessandro Spagnuolo I3BB
		</footer>
	</body>
</html>