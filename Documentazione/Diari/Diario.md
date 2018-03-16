# PROGETTO | Diario di lavoro - 02.02.2018
##### Gionata Battaglioni
##### Gabriele Dominelli
##### Fabio Gola
##### Lucas Previtali
### Canobbio, [02.02.2018]

## Lavori svolti
Gionata

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:15 - 11:35 |Messa in funzione della webCam su raspberry||10:30 -                   
|13:15 - 16:30 |Sistemazione di multeplici errori presenti sul raspberry, legati al webserver|


Gabriele

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 16:30 |assente. |


Fabio

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|8:30 - 16:30 |Impementazione sistema di recensione|


Lucas


|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|8:20 - 10:50 |finito l'invio dei dati dalla pagina dell'admin al database |
|10:50 - 15:00 |collegamento della pagina dell'admin con la pagina dei grafici. messa in funzione del login solo tramite username e password definiti nella tabella amministratore nel database |
|15:00 - 15:45 |spostamento delle pagine sul rasperry e prova delle due pagine (che al momento non funzionano correttamente sul rasperry)|
|15:45 - 16:30 | gestione errori delle pagine sul rasperry + creazione pagina "di supporto" per la connessione al database|



##  Problemi riscontrati e soluzioni adottate
1. la query usata per l'invio dei dati dalla pagina dell'admin al database non funzionava usando ajax (quindi con il codice scritto su un file php separato). Ho dovuto modificare la pagina, integrandola in un form per poter gestire l'inivo con il metodo "post".
2. le funzioni msql_query() e mysql_num_rows() usate per il controllo del nome utente e passsword dell'admin non funzionavano. Cercando in internet ho trovato un alternativa semplice, le funzioni msqli_query() e mysqli_num_rows()
3. il webserver presentava diversi errori e mananze dovute alle multeplici installazioni fatte su di esso. Per risolvere i problemi ho dovuto inseieme al docente scaricare e attivare il file mysqli, attivare la ssl per avere un https. Inoltre legato alla webCam per farla funzionare ho scaricato diversi programmi per mettere in funzione al webCam. Come per esempio un edisto che mi mostra fotoe vido e mi accende la WebCam. Un errore é che una volta che abbiamo portato i file dal computer personale al webserver sono comparsi errori inesistenti in precedenza. Tuttora alcuni erroi sono irrisolti
##  Punto della situazione rispetto alla pianificazione
- 

## Programma di massima per la prossima giornata di lavoro
- Sistemare gli errori dati dalle pagine e i plementare l`indice di gradimente all`interno della pagina dei grafici.
