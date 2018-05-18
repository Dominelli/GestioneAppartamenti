# PROGETTO | Diario di lavoro - 18.05.2018
##### Alessandro Spagnuolo
##### Gabriele Dominelli
### Canobbio, [18.05.2018]

## Lavori svolti
Alessandro

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 11:35 ||

Gabriele

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 10:00 |Piccoli aggiustamenti CSS alla pagina di index, delle riservazioni e dell'aggiunta di un appartamento.|
|10:00 - 11:35 |Ho svuotato tutte le tabelle del DB per partire da 0. Ho aggiunto 9 appartamenti simili ad un caso reale.|


##  Problemi riscontrati e soluzioni adottate
 - Gabriele: Dopo aver svuotato il DB da tutti gli appartamenti fasulli e aggiungendo degli esempi più realistici, ho notato che il non mettere un'immagine di piantina avveniva un errore sulla query di MySQL. Inoltre, ci siamo resi conto che la tipologia della variabile in cui era salvata la piantina sul DB, era un "blob" invece di un "mediumblob". Prima della modifica, nel momento in cui stampavamo le immagini a schermo, venivano tutte tagliate dopo 64KB.
Alla consegna del progetto non saranno presenti i bottoni che permettono l'ulteriore esplorazione degli annunci oltre ai 6 già presenti a schermo.
Inoltre non esiste una pagina che permetta ad un utente admin di rendere proprietario qualcuno tramite interfaccia grafica. Questa operazione dovrà essere eseguita per forza tramite PHPMyAdmin.

##  Punto della situazione rispetto alla pianificazione
 - Gabriele: ho lavorato altre 3 ore a casa per recuperare il lavoro non concluso in classe. Più precisamente, ho concluso la pagina per la gestione degli appartamenti.
