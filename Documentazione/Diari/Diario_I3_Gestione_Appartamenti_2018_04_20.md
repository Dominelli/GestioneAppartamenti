# PROGETTO | Diario di lavoro - 20.04.2018
##### Alessandro Spagnuolo
##### Gabriele Dominelli
### Canobbio, [20.04.2018]

## Lavori svolti
Alessandro

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 09:20 |Abbiamo discusso con Mussi e Sartori a riguardo dello stato attuale del progetto e abbiamo chiarito ulteriori dettagli|
|09:20 - 10:00 |Ho perfezionato la pagina di registrazione facendo in modo che la mail di conferma registra completamente l'utente desiderato che ho sviluppato con la connessione al database tramite php facendo un update sullo stato dell'utente, portandolo da 0 (non verificato) a 1 (verificato). Dopodichè l'utente viene reindirizzato alla pagina principale passando con il get nell'url l'utente in questione.|
|10:00 - 14:45 |Ho implementato la pagina di login che controlla che l'utente abbia inserito dei valori validi di un utente esistente grazie alla connessione al database tramite php facendo un select che prende l'utente con cui si vuole fare l'accesso e controlla che sia esistente. Dopodichè lo reindirizza alla pagina principale passando con il get nell'url l'utente in questione.|
|15:00 - 16:30|Ho perfezionato le pagine già esistenti modificandone lo stile e aggiungendo l'header e il footer.|

Gabriele

|Orario        |Lavoro svolto                 |
|--------------|------------------------------|
|08:20 - 09:20 |Abbiamo discusso con Mussi e Sartori a riguardo dello stato attuale del progetto e abbiamo chiarito ulteriori dettagli.|
|09:20 - 14:45 |Ho rivisitato l'intera pagina dell'index. Invece di gestire il resposive tramite JavaScript, ho optato per l'utilizzo di css (in quanto causa meno problemi ed è più comodo per il futuro). Inoltre, adesso la pagina è ottimizzata anche per l'utilizzo da mobile, in quanto lo stile della pagina sotto una certa soglia si sviluppa in verticale.|
|15:00 - 16:30|Ho perfezionato le pagine già esistenti modificandone lo stile.|


##  Problemi riscontrati e soluzioni adottate
 - Con il professor Sartori abbiamo constatato che la tabella "verifica" era inutile (essendo una copia della tabella "utente").
Abbiamo quindi deciso di eliminare la tabella "verifica" e di aggiungere un campo "stato" alla tabella "utente". Questo campo numerico assume uno dei seguenti valori: 0,1. Dove 0 indica un utente non ancora confermato ed 1 invece si.
 - Abbiamo riscontrato dei problemi con il centrare degli elementi utilizzando il css, dopo averne parlato con il professor Mussi abbiamo capito il problema che era l'indentazione non corretta del codice e dei piccoli errori di chiusura di alcuni tag.

##  Punto della situazione rispetto alla pianificazione
In orario rispetto al programma.


## Programma di massima per la prossima giornata di lavoro
Continuazione dello sviluppo per le pagine web.
