1. [Introduzione](#introduzione)
  - [Informazioni sul progetto](#informazioni-sul-progetto)
  - [Abstract](#abstract)
  - [Scopo](#scopo)
2. [Analisi](#analisi)
  - [Analisi del dominio](#analisi-del-dominio)
  - [Analisi dei mezzi](#analisi-dei-mezzi)
  - [Analisi e specifica dei requisiti](#analisi-e-specifica-dei-requisiti)
  - [Use case](#use-case)
  - [Pianificazione](#pianificazione)
3. [Progettazione](#progettazione)
  - [Design dell’architettura del sistema](#design-dell’architettura-del-sistema)
  - [Design dei dati e database](#design-dei-dati-e-database)
4. [Implementazione](#implementazione)
5. [Test](#test)
  - [Protocollo di test](#protocollo-di-test)
  - [Risultati test](#risultati-test)
  - [Mancanze/limitazioni conosciute](#mancanze/limitazioni-conosciute)
6. [Consuntivo](#consuntivo)
7. [Conclusioni](#conclusioni)
  - [Sviluppi futuri](#sviluppi-futuri)
  - [Considerazioni personali](#considerazioni-personali)
8. [Sitografia](#sitografia)
9. [Allegati](#allegati)


## Introduzione

### Informazioni sul progetto

 - **Progetto svolto da:** Gabriele Dominelli, Alessandro Spagnuolo
 - **Mandanti del progetto:** Massimo Sartori
 - **Docente Responsabile:** Massimo Sartori
 - **Scuola:** Arti e Mestieri Trevano
 - **Sezione:** Informatica
 - **Classe:** I3AA / I3BB
 - **Data d’inizio:** 16.03.2018
 - **Termine della consegna:** 18.05.2018


### Abstract

At the beginning  teachers in charge showed us the project, how it had to be done and what
we would have to do to keep an appropriate organization. At the beginning we had some trouble. The main problem was figuring out how all our requirements would be working toghether.
Another problem was building an appropriate ER-schema, enough elaborated for our situation.
Anyway, the final result would require some good team work. Both of us have to mix and learn several diffrent experiences. 


### Scopo

  Questo progetto consiste nell'implementazione di un'applicazione web che permetta di gestire l'affitto di appartamenti in Svizzera.


## Analisi

### Analisi del dominio

  Il progetto completo verrà presentato principalmente a un pubblico potenzialmente senza conoscenze informatiche. Le interfaccie e le funzionalità dovranno essere intuitive e seguiranno gli standard dei siti di fama più alta.

  
### Analisi e specifica dei requisiti

  Il committente richiede una struttura web che sia in grado di gestire l'affitto e la riservazioni di molti locali. Una volta che l'utente proprietario dell'appartamento le informazioni vengono salvate all'interno di un database. In un secondo momento altri utenti possono esplorare le specifiche dello spazio e procedere con un eventuale affitto o riservazione. 

  
|ID          |REQ-001                                         |
|------------|------------------------------------------------|
|**Nome**    |Pagina principale                               |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Pagina di default della struttura del sito.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Sarà presente una descrizione del sito.                  |
|**002**     | Lista degli appartamenti, 6 per volta.              |
|**003**     | Pulsanti per login/istrizione.              | 


|ID          |REQ-002                                         |
|------------|------------------------------------------------|
|**Nome**    |Filtri di ricerca                             |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Filtro di ricerca da applicare alla pagina principale.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Filtro per “con o senza periodo”.                  |
|**002**     | Filtro per “numero di locali”.              |
|**003**     | Filtro per “Prezzo”.              | 


|ID          |REQ-003                                         |
|------------|------------------------------------------------|
|**Nome**    |Pagina di login                              |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Per utente già esistente.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Accessibile dal pulsante della pagina principale “Accedi”.                  |
|**002**     | Campo di username e password.              |
|**003**     | Confermare l’accesso.              | 
|**004**     | Riporta alla pagina principale con l’utente desiderato.  |


|ID          |REQ-004                                         |
|------------|------------------------------------------------|
|**Nome**    |Pagina di registrazione                              |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Pagina per l’aggiunta di un nuovo appartamento.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Accessibile dal pulsante della pagina principale “Registrati”. E dopo la creazione di un nuovo utente.|
|**002**     | Inserimento di username, password, nome, cognome, indirizzo, tel privato, tel ufficio ed email come campi obbligatori.|
|**003**     |Convalida dati.     | 
|**004**     | Controllo l’utente non sia già esistente. |                
|**005**     | Invio email con link di conferma.                   |
|**006**     | Riporta alla pagina di Login, per re-inserire le credenziali.             |


|ID          |REQ-005                                         |
|------------|------------------------------------------------|
|**Nome**    |Pagina creazione appartamento                               |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Pagina per l’aggiunta di un nuovo appartamento.|
|**Sub-ID**  | Requisito                                      |
|**001**     | È prima necessario essere un utente proprietario.                  |
|**002**     | Richiesta obbligatoria dei seguenti campi:
||	- Regione e Paese|
||	- Una o più foto|
||	- Pianta dell’appartamento.|
||	- Numero di locali|
||	- Posteggio (booleano + ev. quantità)|
||	- Prezzo (alta e bassa stagione, settimanale, mensile, annuale)|
||	- Spese|
||	- Accessori (lista)|
||	- Ammobiliato (booleano)|
||	- Fumatori (booleano)|
||	- Animali (booleano)|
||	- Bambini (booleano)|
||	- Ubicazione + carta|
||	- Disponibilità|
||	- Commenti|
|**003**     |Aggiunta automatica del nome, cognome, tel privato e email del proprietario.          | 
|**004**     | Salvataggio nel DB.  |



|ID          |REQ-006                                         |
|------------|------------------------------------------------|
|**Nome**    |Visualizzazione singolo appartamento                               |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Pagina che mostra le specifiche per ogni appartamento.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Per utenti non registrati:|
|| - Visione di tutti i campi definiti nel REQ-005 tranne i contatti del proprietario.|
 
 
|ID          |REQ-007                                         |
|------------|------------------------------------------------|
|**Nome**    |Utente non registrato                               |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Specifiche di un utente non registrato.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Può navigare liberamente per il sito senza però avere possibilità di richiedere di diventare proprietario di un appartamento e di visualizzare i contatti di un altro proprietario.|


|ID          |REQ-008                                         |
|------------|------------------------------------------------|
|**Nome**    |Utente registrato                           |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Specifiche di un utente registrato.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Può navigare liberamente per il sito ed utilizzare tutti i servizi. Può richiedere di diventare un proprietario contattando un gestore.|
 

|ID          |REQ-009                                         |
|------------|------------------------------------------------|
|**Nome**    |Utente proprietario                               |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Specifiche di un utente proprietario.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Può navigare liberamente per il sito ed utilizzare tutti i servizi. Può aggiungere un appartamento.                 |


|ID          |REQ-010                                         |
|------------|------------------------------------------------|
|**Nome**    |Utente gestore/amministratore                   |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Specifiche di un utente registrato.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Naviga liberamente nel sito ed è un utente proprietario.        |
|**002**     | Gestisce gli utenti:
|| - Inserimento utenti|
|| - Modifica utenti|
|| - Cancellazioni utenti|
|| - Visualizzazione utenti|
 
 
|ID          |REQ-011                                         |
|------------|------------------------------------------------|
|**Nome**    |Creazione del DataBase                             |
|**Priorità**|1                                               |
|**Versione**|1.0                                             |
|**Note**    |Database contenente la lista di appartamenti.|
|**Sub-ID**  | Requisito                                      |
|**001**     | Creazione di uno schema ER.          |
|**002**     | Creazione di uno schema logico.    |
|**003**     | Contiene gli utenti non registrati, utenti registrati, utenti proprietari e gestori.      | 
|**004**     | Registra tutte le informazioni di ogni appartamento.  |

 


### Use case

Questo prodotto sarà un candidato degno di nota per la sostituzione di siti più conosciuti come tutti.ch ed affini.

### Pianificazione

Questo é il Gantt che abbiamo realizzato in base alla lista dei requisiti che abbiamo redatto e al tempo a disposizione.

![Gantt Preventivo](img/GANTT_Preventivo.jpg)




### Analisi dei mezzi
Come prodotti fisici abbiamo usato i seguenti:

| Proodotto | Caratteristiche |
|    :--    |    --:    |
|  PC portatile  |  Windows 10  |

| Pacchetto| Versione |
|    :--    |    --:    |
|  Apache  |   2.4.25 |
|  Php  |  7.0.19  |
|  MariaDB  |  10.1.23  |


### Analisi dei costi

#### Costo totale:
Non necessitando di mezzi specifici, gli unici costi sono quelli dei dipendenti.

|Costo per ora| Ore | Persone | Totale |
|----------------|----------------|----------------|----------------|
|60 fr.       |60|2|7200 fr.|


## Progettazione

### Design dei dati e database

Il database che abbiamo creato è abbastanza complesso, difatti abbiamo dovuto riguradare diversi aspetti prima di arrivare alla soluzione finale.

```sql

use efof_gestaff_2018;
create table if not EXISTS utente(
nome varchar(50) not null,
cognome varchar(50) not null,
username varchar(50), 
email varchar(50),
password varchar(50),
n_cellulare int not null,
n_ufficio int not null,
admin tinyint,
proprietario tinyint,
stato int,
primary key(username)
);
create table if not EXISTS appartamento(
id int primary key,
bambini tinyint,
fumatori tinyint,
piantina mediumblob,
animali tinyint,
titolo varchar(50),
regione varchar(50),
n_locali int,
posteggio tinyint,
paese varchar(50),
ammobiliato tinyint,
ubicazione varchar(50),
commenti text,
username_prop varchar(50),
foreign key(username_prop) references utente(username) on delete cascade on update cascade
);

create table if not EXISTS foto(
id int AUTO_INCREMENT PRIMARY KEY,
foto mediumblob,
id_appartamento int,
foreign key(id_appartamento) REFERENCES appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS accessori(
nome varchar(30),
id_appartamento int,
primary key(nome, id_appartamento),
foreign key(id_appartamento) REFERENCES appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS tipo(
tipo varchar(50) primary KEY
);
create table if not EXISTS prezzo(
prezzo int,
tipo varchar(50),
id_appartamento int,
foreign key(tipo) references tipo(tipo) on delete cascade on update cascade,
foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade,
primary key (prezzo, tipo, id_appartamento)
);
create table if not EXISTS spesa(
id int AUTO_INCREMENT PRIMARY KEY,
nome varchar(50),
prezzo int,
id_appartamento int,
foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade
);
create table if not EXISTS riserva(
data_inizio date,
data_fine date,
id_appartamento int,
username_utente varchar(50),
email_utente varchar(50),
password_utente varchar(50),
primary key(data_inizio, data_fine, id_appartamento, username_utente, email_utente, password_utente),
foreign key(id_appartamento) references appartamento(id) on delete cascade on update cascade,
foreign key(username_utente) references utente(username) on delete cascade on update cascade
);

 
```

### Schema E-R, schema logico e descrizione.

Questo é il diagramma ER del database generato per consentire lo scambio dei dati tramite le varie pagine web.

![Scherma E-R](img/Schema_ER_Database.jpg)

### Design delle interfacce

Qui di seguito sono riportate le progettazioni iniziali per tutte le pagine che abbiamo realizzato in questo progetto:
![Pagina Principale](img/Mockup_Index.JPG)
![LogIn](img/MockUp_Login.jpg)
![Registrazione](img/MockUp_Registrazione.jpg)
![Aggiunta appartamento](img/MockUp_AggiuntaAppartamento.JPG)
![Visualizzazione appartamento](img/MockUp_Visualizzazione_Appartamento.jpg)
![Gestione Riservazioni](img/MockUp_Gestione_Riservazioni.JPG)

## Implementazione

### Supporto

Come progetto è soltanto di programmazione, quindi abbiamo utilizzato i nostri computer personale per implementare il codice.

### Creazione pagina di registrazione

La pagina di registrazione è la pagina che permette agli utenti del sito web di registrarsi e di creare quindi il proprio account personale.
È composto da un form HTML contenente una tabella che a sua volta contiene vari tipi di input che in base al loro tipo vengono controllati con delle funzioni JavaScript, come ad esempio il campo di inserimento dell'email personale:
Questo è il codice per mostrare il campo di inserimento:

~~~html
<tr>
	<td valign="top">
	<label for="Email_Address"><span>Indirizzo email * </span></label>
	</td>
	<td valign="top">
		<input type="text" name="Email_Address" id="Email_Address" maxlength="100" style="width:230px" onchange="checkEmail()">
	</td>
</tr>
~~~~

Invece questo è il codice che controlla che l'email sia stata scritta correttamente:

~~~javascript
//funzione che controlla il contenuto dell'email immessa dall'utente
//tramite una regexp
function checkEmail(){
	email = document.getElementById('Email_Address').value;
	if(email == ""){
			alert("The email isn't correct");
			document.getElementById('Email_Address').value = "";
			return false;
	}
	else if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){  
		return true;
	} 
	else{
		alert("The email isn't correct");
		document.getElementById('Email_Address').value = "";
		return false;
	} 
}
~~~

Semplicemente controlla con un'equazione regexp la correttezza dell'email.
In caso che manchino delle informazioni nel form, l'utente viene mandato ad una pagina che mostra un semplice testo che spiega all'utente che ci sono stati degli errori con la registrazione e viene quindi chiesto di tornare indietro a ricompilare il form.

Nel form c'è il bottone di submit che manda il contenuto del form tramite il metodo POST alla pagina php che prende i dati e li mette nel database e allo stesso tempo manda un'email all'utente interessato per permettere la registrazione totale del proprio account, dato che inizialmente il profilo viene inserito nel databse come utente non attivato quindi con stato = 0:

~~~php
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
~~~

Mentre questo è il codice che permette l'invio dell'email dove preparo il nome del mittente e il contenuto del testo:

~~~php
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
~~~

Dopodichè reindirizzo l'utente alla pagina principale del sito dove ha la possibilità di fare il suo login soltanto se ha attivato il suo account cliccando sul link inviato tramite l'email mandata precedentemente:

~~~php
 //reindirizzo l'utente alla pagina seguente
 header("Location: thankyou.htm");
~~~

La pagina thankyou.html mostra a schermo un ringraziamento per la registrazione e reindirizza l'utente alla pagina principale:

~~~javascript
function redirect(){
	setTimeout("window.location='http://samtinfo.ch/gestaff/index.php'",3000);
}
~~~

Dopo che l'utente ha cliccato il link mandato tramite email, che contiene nell'url l'username dell'account in questione, viene mandato alla pagina email_verification.php che si preoccupa di confermare l'account impostando sul database lo stato dell'utente interessato = 1 quindi attivato:

~~~php
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
~~~

Dopodichè l'utente viene reindirizzzato alla pagina principale in modo da rendere possibile il suo login:

~~~javascript
//funzione che reindirizza l'utente dopo 3 secondi alla pagina principale
function redirect(){
	setTimeout("window.location='http://samtinfo.ch/gestaff/index.php'",3000);
}
~~~

### Creazione pagina di login

La pagina di login ha un form HTML che contiene una tabella che a sua volta contiene due campi di inserimento: uno per l'username e uno per la password. Al di sotto di questi campi c'è il bottone di submit che manda tramite il metodo POST le informazioni dell'utente che vuole fare il login.

~~~html
<tr>
	<td valign="top">
	<label for="Username"><span>Username * </span></label>
	</td>
	<td valign="top">
	<input type="text" name="Username" id="Username" maxlength="80" style="width:230px">
	</td>
</tr>
<tr>
	<td valign="top">
	<label for="Password"><span>Password * </span></label>
	</td>
	<td valign="top">
	<input type="password" name="Password" id="Password" maxlength="80" style="width:230px">
	</td>
</tr>
<tr>
	<td colspan="2" style="text-align:center" >
	<br />
	<input type="submit" value=" Vai! " id="submit" style="width:200px;height:40px">
	</td>
</tr>
~~~

La pagina a cui viene reindirizzato l'utente tramite il bottone di submit si occupa di controllare che l'account con cui si vuole fare il login esista e che sia attivato, quindi con lo stato = 1:

~~~php
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
~~~

### Creazione pagina di aggiunta di una appartamento

La pagina di aggiunta di un appartamento contiene anche questa un form HTML con vari campi di inserimento di vari tipi che, come spiegato nei requisiti, deve contenere degli input anche per le immagini dell'appartamento e della piantina dell'appartamento.
All'inizio ho avuto alcuni problemi con le immagini dato che possono anche essere inserite più di un'immagine, ma sono riuscito a risolvere il problema constatando su internet delle soluzioni.
Il form permette di inserire molteplici spese, ognuna con il proprio nome e il prezzo, e accessori, ognuno con il proprio nome, per risolvere questo dilemma ho optato a utilizzare una funzione javascript che ho creato personalmente che, usando le proprietà dei children dei tag HTML, permette di aggiungere i campi necessari per l'inserimento dei dati ognuno con il proprio nome che servirà alla pagina php per riconoscere l'input corretto:

~~~javascript
//Variabili che indicano il numero di input riguardanti la spesa
//In modo da concatenarli al name dell'elemento
//per poterlo riconoscere in PHP
var s = 1;
var c = 1;
//Funzione che aggiunge gli elementi per una nuova spesa
function addSpesa(){
	var nomeSpesa = document.createElement("input");
	var costoSpesa = document.createElement("input");
	nomeSpesa.setAttribute("type", "text");
	nomeSpesa.setAttribute("name", "Spesa"+s);
	s++;
	nomeSpesa.setAttribute("maxlength", "100");
	nomeSpesa.setAttribute("style", "width: 200px;");
	costoSpesa.setAttribute("type", "number");
	costoSpesa.setAttribute("name", "CostoSpesa"+c);
	costoSpesa.setAttribute("step", "0.05");
	costoSpesa.setAttribute("maxlength", "100");
	costoSpesa.setAttribute("min" ,"0");
	costoSpesa.setAttribute("style", "width: 100px;");
	document.getElementById("spese").appendChild(nomeSpesa);
	document.getElementById("spese").appendChild(costoSpesa);
	document.getElementById("sp").value = parseInt(document.getElementById("sp").value)+1; 
}
//variabile che indica il numero di elementi riguardanti gli accessori
//per poterlo riconoscere in PHP
var a = 1;
//Funzione che aggiunge un elemento per un nuovo accessorio
function addAccessorio(){
	var nomeAccessorio = document.createElement("input");
	nomeAccessorio.setAttribute("type", "text");
	nomeAccessorio.setAttribute("name", "Accessorio"+a);
	a++;
	nomeAccessorio.setAttribute("maxlength", "100");
	nomeAccessorio.setAttribute("style", "width:200px;");
	document.getElementById("accessori").appendChild(nomeAccessorio);
	document.getElementById("acc").value = parseInt(document.getElementById("acc").value)+1;
}
~~~

Le funzioni vengono richiamate quando l'utente preme sui pulsanti "+" di fianco ai campi delle spese e accessori:

~~~html
<span onclick="addSpesa()" style="width: 10px; height: 10px; border: 0.5px solid black; background: lightgray; padding: 4px;">+</span>
<span onclick="addAccessorio()" style="width: 10px; height: 10px; border: 0.5px solid black; background: lightgray; padding: 4px;">+</span>
~~~

Ho dovuto utilizzare degli span perchè non potevo usare altri bottoni nel form dato che ogni bottone contenuto in un form ha di default la funzione di fare da submit e quindi ho dovuto falsare la funzionalità di un bottone.
Quando l'utente preme sul bottone di submit viene reindirizzato alla pagina php che controlla che i campi obbligatori siano stati inseriti e aggiunge tutti i dati nel database, dopodichè l'utente viene reindirizzato alla pagina principale del sito web dove potrà cercare tranquillamente il suo appartamente che apparirà come ultimo annuncio creato.

~~~php
//avvio la sessione per recuperare l'utente
session_start();
$u;
if(isset($_SESSION['user'])){
$u = $_SESSION['user'];
//controllo che ci siano i campi obbligatori
if(isset($_POST['Titolo']) && isset($_POST['Paese']) && isset($_POST['Regione']) && isset($_POST['NumeroLocali']) && isset($_POST['Prezzo']) && isset($_POST['SceltaPrezzo']) && isset($_POST['Indirizzo']) && isset($_POST['Commenti'])){
	//istanzio le variabili con il valore dei rispettivi campi
	$titolo = $_POST['Titolo'];
	$paese = $_POST['Paese'];
	$regione = $_POST['Regione'];
	$numeroLocali = $_POST['NumeroLocali'];
	$posteggio = $_POST['Posteggio'];
	$pianta = "null";
	$foto = "null";
	if(isset($_FILES['Pianta']) && $_FILES['Pianta']['tmp_name'] != "")
		$pianta = addslashes(file_get_contents($_FILES['Pianta']['tmp_name']));
	$prezzo = $_POST['Prezzo'];
	$sceltaPrezzo = $_POST['SceltaPrezzo'];
	$spesa = $_POST['Spesa'];
	$costoSpesa = $_POST['CostoSpesa'];
	$accessorio = $_POST['Accessorio'];
	$ammobiliato = $_POST['Ammobiliato'];
	$fumatori = $_POST['Fumatori'];
	$animali = $_POST['Animali'];
	$bambini = $_POST['Bambini'];
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
~~~

Ma prima di aggiungere l'appartamento prendo il valore dell'ultimo id degli appartamenti contenuti nel database in modo da inserire un id disponibile:
~~~php
$id;
//preparo la query 
$sql = "select max(id) from appartamento";
if($conn->query($sql) == FALSE) {
	echo "<p>C'è stato un errore con l'aggiunta del tuo appartamento</p><p>Per favore torna indietro e riprova</p>";
}
else{
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	  //output data of each row
		while($row = $result->fetch_assoc()) {
			$id = $row['max(id)'];
		}
	}
}
$id++;
~~~

Dopodichè inserisco le varie informazioni dell'appartamento nel database:

~~~php
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
//conto il totale delle foto per poi metterle nel database
$total = count($_FILES['Foto']['name']);
for($i=0; $i<$total; $i++) {
	$foto = addslashes(file_get_contents($_FILES['Foto']['tmp_name'][$i]));
	$sql = "INSERT INTO foto(foto, id_appartamento) VALUES ('{$foto}', $id)";
  //controllo che la query non dia errori
	if ($conn->query($sql) === TRUE) {

	}
  //altrimenti stampo l'errore
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
}
//prendo il totale degli accessori e poi li metto nell database
if($accessorio != null){
	for($i = 1; $i <= $_POST['acc']; $i++){
		$sql = "INSERT INTO accessori(nome, id_appartamento) VALUES ('$accessorio', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {

		}
	  //altrimenti stampo l'errore
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$accessorio = $_POST['Accessorio'.$i];
	}
}
$sql = "INSERT INTO prezzo(prezzo, tipo, id_appartamento) VALUES ('$prezzo', '$sceltaPrezzo', '$id')";
//controllo che la query non dia errori
if ($conn->query($sql) === TRUE) {

}
//altrimenti stampo l'errore
else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
//prendo il totale delle spese e le metto nel database
if($spesa != null && $costoSpesa != null){
	for($i = 1; $i <= $_POST['sp']; $i++){
		$sql = "INSERT INTO spesa(nome, prezzo, id_appartamento) VALUES ('$spesa', '$costoSpesa', '$id')";
	  //controllo che la query non dia errori
		if ($conn->query($sql) === TRUE) {

		}
	  //altrimenti stampo l'errore
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$spesa = $_POST['Spesa'.$i];
		$costoSpesa = $_POST['CostoSpesa'.$i];
	}
}
//chiudo la connessione
$conn->close();
}
~~~

Se ci sono degli errori nell'inserimento nel database l'utente viene reindirizzato ad una pagina di errore dove si viene chiesto di ricompilare il form in modo da non avere problemi nell'inserimento:

~~~php
header("Location: error.htm");
~~~

Se invece non ci sono errori e l'inserimento va a buon fine l'utente viene reindirizzato alla pagina principale:

~~~javascript
<p>Il tuo appartamento è stato aggiunto.</p>
<p>Verrai reindirizzato in 3 secondi..</p>
<script type="text/javascript">
  //funzione che reindirizza l'utente dopo 3 secondi alla pagina principale
  function redirect(){
	setTimeout("window.location='http://samtinfo.ch/gestaff/index.php'",3000);
  }
</script>
~~~

### Creazione pagina di visualizzazione di un singolo appartamento

La pagina di visualizzazione di un singolo appartamento viene richimata quando l'utente clicca su di un appartamento mostrato nella pagina principale. Una volta cliccato si passa nell'url tramite get l'id dell'appartamento da visualizzare in modo da mostrare l'appartamento giusto. La pagina contiene una tabella in cui vengono mostrate tutte le informazioni dell'appartamento in questione che vengono prese tramite delle query sql in php:

~~~php
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
~~~

I dati recuperati in php vengono poi mostrati nell'html tramite degli echo che stampano il contenuto delle variabili come ad esempio per il titolo dell'appartamento:

~~~html
<tr><td><h1 style="font-size="40px"><?php echo $titolo; ?></h1></td></tr>
~~~

Invece per le immagini, che sono contenute in un array in php, ho trasformato l'array in php in uno in javascript in modo da poterle stampare correttamente nell'html. Ma di default viene visualizzata soltanto la prima immagine dell appartamento, ma se l'appartamento non contiene immagini allora viene mostrata un immagine di default:

~~~javascript
var immagini = ['<?php echo implode("','",$immagini);?>'];
for(var i = 0; i < immagini.length; i++){
	if(immagini[i] != ""){
		output = "<img src='data:image/png;base64,"+immagini[0]+"' style='padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;'>";
		images += "<img src='data:image/png;base64,"+immagini[i]+"' style='padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;'>";
	}
	else output = "<img src='../index/img/default_room.png'>";
}
~~~

Se si vogliono vedere tutte le immagini l'utente può cliccare su un bottone che richiama una funzione javascript che ho creato personalmente che mostra in un div hmtl che all'inizio viene inizializzato come hidden, quindi nascosto, e la funzione si occupa di mostrare il div dove vengono messe tutte le immagini dell'appartamento come fosse una galleria di immagini:

~~~html
<td><div id="all" hidden style="background-color: white; text-align: center;"></div></td>
~~~

~~~javascript
function allImages(){
	if(immagini.length > 1){
		document.getElementById("all").hidden = false;
		document.getElementById("all").innerHTML = images;
	}
	else{
		document.getElementById("noImg").hidden = false;
	}
}
~~~

Mentre per le spese e gli accessori, dato che possono essere più di uno, ho preparato degli array in javascript che prendono il valore degli array in php e tramite dei cicli for vengono stampati nei corrispettivi div:

~~~html
<td>Spese:<div id="spese"></div></td>
<td>Accessori:<div id="accessori"></div></td>
~~~

~~~javascript
var accessori = ['<?php echo implode("','",$accessori);?>'];
var nomeSpese = ['<?php echo implode("','",$nomeSpesa);?>'];
var prezzoSpese = ['<?php echo implode("','",$prezzoSpesa);?>'];
for(var i = 0; i < accessori.length; i++){
	document.getElementById("accessori").innerHTML += "<span>"+accessori[i]+"</span><br>";
}
for(var i = 0; i < nomeSpese.length; i++){
	if(nomeSpese[i] != "")document.getElementById("spese").innerHTML += "<span>"+nomeSpese[i]+" </span><span>" +prezzoSpese[i]+".-</span><br>";
}
~~~

Invece per la piantina c'è semplicemente un if che controlla che l'immagine non sia vuota e se non lo è viene mostrata nel corrispettivo div:

~~~html
<td><div id="piantina">Piantina: <img src="data:image/png;base64,<?php echo $piantina; ?>" style="padding: 0px; margin: 0px; max-width: 400px; max-height: 250px; height: auto; width: auto;"></div></td>
~~~

~~~javascript
var piantina = '<?php echo $piantina; ?>';
//la stringa di caratteri 'bnVsbA==' corrisponde ad un immagine che non esiste quindi vuota
if(piantina == 'bnVsbA==')
	document.getElementById('piantina').innerHTML = "<img src='../index/img/default_room.png'>";
~~~

### Creazione Database

Per far si che le pagine comunicano e si scambino i dati tra di solo é stato necessario creare un database.
Per crearlo abbiamo usato phpmyadmin che abbiamo ricevuto tramite email con le credenziali.
Abbiamo semplicemente inserito il codice sql mostrato in precedenza e l'abbiamo fatto partire.

## Test

### Protocollo di test

Le tabelle  sottostanti rappresentano i test che abbiamo svolto in base hai requisiti che abbiamo scelto e creato.

|Test Case      | TC-001                              |
|---------------|--------------------------------------|
|**Nome**       |Pagina di registrazione |
|**Riferimento**|REQ-004                              |
|**Descrizione**|Creare un utente per provare il funzionamento della pagina|
|**Prerequisiti**||
|**Procedura**     | - Dalla pagina principale e cliccare sul pulsante con la scritta "registrazione". - Immettere i dati necessari nei campi di inserimento del form. - Cliccare il pulsante submit.|
|**Risultati attesi** |Ricevere un email di conferma della registrazione dell'account|

|Test Case      | TC-002                              |
|---------------|--------------------------------------|
|**Nome**       |Pagina di verifica dell'account|
|**Riferimento**|REQ-004                               |
|**Descrizione**|Click sul link ricevuto tramite email per verificare il proprio account|
|**Prerequisiti**||
|**Procedura**     | - Dalla posta personale cliccare il link ricevuto.|
|**Risultati attesi** |Essere reindirizzati alla pagina principale senza nessun errore|

|Test Case      | TC-003                              |
|---------------|--------------------------------------|
|**Nome**       |Pagina di login|
|**Riferimento**|REQ-003                               |
|**Descrizione**|Login con il proprio utente|
|**Prerequisiti**||
|**Procedura**     | - Dalla pagina principale cliccare sul pulsante con scritto "login". - Immettere i propri dati. - Cliccare il pulsante di submit.|
|**Risultati attesi** |Essere reindirizzati alla pagina principale senza nessun errore con il proprio account loggato.|

|Test Case      | TC-004                              |
|---------------|--------------------------------------|
|**Nome**       |Pagina di aggiunta di un appartamento|
|**Riferimento**|REQ-005                               |
|**Descrizione**|Aggiunta di un appartamento in modo da inserirlo nel database|
|**Prerequisiti**||
|**Procedura**     | - Dalla pagina principale cliccare sul pulsante con scritto "appartamenti" e scegliere l'opzione "aggiunta appartamenti". - Immettere i dati dell'appartamento che si vuole aggiungere. - Cliccare il pulsante di submit.|
|**Risultati attesi** |Essere reindirizzati alla pagina principale senza nessun errore.|

|Test Case      | TC-005                              |
|---------------|--------------------------------------|
|**Nome**       |Pagina di visualizzazione di un signolo appartamento|
|**Riferimento**|REQ-006                               |
|**Descrizione**|Visualizzazione dell'appartamento|
|**Prerequisiti**||
|**Procedura**     | - Dalla pagina principale cliccare su di un appartamento mostrato a schermo.|
|**Risultati attesi** |Essere reindirizzati alla pagina che mostra le informazioni dell'appartamento cliccato.|

### Risultati test

I risultati dei test sono tutti andati a buon fine, da come abbiamo provato molteplici volte tutte le pagine funzionano correttamente senza alcun tipo di errore non desiderato.

### Mancanze e limitazioni conosciute



## Consuntivo

Il progetto è andato come speravamo e abbiamo rispettato al completo i tempi. Se non fosse soltanto che abbiamo avuto una lezione e mezza in meno dato che le ultime due lezioni sono state prese per fare le presentazioni di tutti i progetti e quindi abbiamo dovuto velocizzare i tempi ma siamo riusciti a rispettare la pianificazione.



## Conclusioni

La soluzione che abbiamo portato ci soddisfa ma non al 100%. Il nostro programma avrà sicuramente un impatto positivo con le persone che lo proveranno, porterà molto divertimento. Noi non pensiamo che il nostro programma cambierà il mondo ma siamo sicuri che porterà una piccola svolta, sicurament più per noi stessi che per gli altri. Possiamo definire questo progetto un successo importante, più che successo questo progetto ci porta un forte orgoglio personale sopratutto perchè verrà utilizzato da gente esterna alla nostra scuola. Questo progetto é una grande aggiunta alla nostra crescita professionale, ci ha dato molto questo progetto sia come competenze lavorative che come competenze sociali.


### Sviluppi futuri
 Come miglioria potrebbe essere implementato in una scala molto più grande rispetto che un semplice schermo con una webcam. Sarebbe bello poter collegare il nostro progetto su delle videocamere reali in modo da riuscire a riconoscere una quantità maggiore di volti. Mentre come sviluppo futuro vorremmo riuscire a migliorare il nostro prodotto, in modo da avere un programma che funzioni alla perfezione.

### Considerazioni personali
  Con questo progetto abbiamo imparato cosa vuol dire lavoro di squadra, di quanto esso sia estremamente importante e di come con dei collaboratori sia più facile e eccitante lavorare.

## Sitografia

- https://trackingjs.com/, *Tracking.js
    La libreira per implementare il riconoscimento facciale.
    
- https://www.wikihow.it/Creare-un-Web-Server-su-Raspberry-Pi, *Manuale web-server linux
    Abbiamo usato questo sito per creare un web server su raspberry.
    
- https://www.raspberrypi.org/downloads/raspbian/, *Sitema operativo Raspbian
    Abbamo scaricato il sistema operativo direttamente dal sito del produttore di raspberry.
    
- http://www.vemp.org/raspberrypi/preparare-una-card-sd-con-raspbian/, *Programma per caricare il .img di raspbian su raspberry.
- https://www.w3schools.com/js/, *Guida JavaScript
    Abbiamo utilizzato questa guida per eventuali errori o mancanze delle nostre competenze sul linguaggio.
    
- https://www.w3schools.com/php/, *Giuida Php
    Abbiamo utlizzato questa guida in caso di mancanze o scarse competenze.
- http://www.chartjs.org/, *pagina per i grafici
    

## Allegati

Elenco degli allegati, esempio:

-   Diari di lavoro

-   Guida utente / Manuale di utilizzo

