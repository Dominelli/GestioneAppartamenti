# PROGETTO | Diario di lavoro - 11.05.2018
##### Alessandro Spagnuolo
##### Gabriele Dominelli
### Canobbio, [11.05.2018]

## Lavori svolti
Alessandro

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 11:35 |Ho ultimato la pagina di inserimento di un nuovo appartamento in modo da prendere molteplici spese e accessori e inserirli nel database in modo corretto.|
|13:15 - 16:30 |Ho iniziato a costruire la pagina di visualizzazione del singolo appartamento prendendo tramite get nell'url il codice identificativo dell'appartamento in modo da mostrare tutte le informazioni riguardanti quest'ultimo.|

Gabriele

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 14:10 |Creazione della pagina php che permette di filtrare le ricerche. Questa pagina è in grado di selezionare gli appartamenti corretti tramite i campi di input presenti su index.php. Il file si appoggia alla variabile globale SESSION per poi passare le informazioni ad index.php. Ancora però non sono stati presi in considerazione i campi data del periodo, in quanto non ancora presenti sul DB.|
|14:10 - 16:30 ||


##  Problemi riscontrati e soluzioni adottate
 - Gabriele: Ho avuto dei problemi a trovare la tecnica più efficacie per mandare i nuovi appartamenti dalla pagina del filtro a quella principale. Per primo ho optato ad inviare tramite GET le query SQL, ma essendo poco sicuro ho optato per interrogare il DB nel file stesso.
 - Alessandro: Ho avuto problemi nella pagina di visualizzazione del singolo appartamento, volevo mostrare tramite una mappa il punto esatto dell'appartamento tramite google maps però ho constatato che per fare quest'azione bisogna pagare per una chiave di attivazione per poter usare le API di Google e quindi ho dovuto mostrare l'indirizzo con un paragrafo all'interno di un div.

##  Punto della situazione rispetto alla pianificazione
Oggi avremmo dovuto finire la pagina che permette la visualizzazione del singolo appartamento e della pagina per la gestione del periodo di un appartamento, riservato ad un utente proprietario.


## Programma di massima per la prossima giornata di lavoro
Continuazione dello sviluppo per le pagine web.
