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

  In questo capitolo raccogliere le informazioni relative al progetto, ad esempio:

  -   Allievo coinvolto nel progetto: Samuel Banfi.

  -   Classe I3BB, Scuola Arti e Mestieri Trevano, sezione Informatica.

  -   Data d'inizio: 09.09.2021

### Abstract

Al giorno d'oggi esistono molti siti per lo scambio e la vendita di prodotti tra privati. Ma questi sono limitati dal fatto che molte volte richiedenti e venditori non riescono a trovarsi per concludere l'affare. Infatti quando viene pubblicata una richiesta, un venditore non è a conoscenza del fatto che è stato aggiunta una nuova richiesta. Deve andare a cercare da solo le richieste, azione che può essere molto oneroso in fattore di tempo. Una soluzione esiste, ed è quella di informare richiedente e venditore, per email o tramite una chat, che
c'è un utente sulla piattaforma che è disposto a vendere il prodotto e un altro utente che è disposto a prenderlo. In questo modo si ha la possibilità di evitare i numerosi sprechi di tempo e così facendo si aumenta anche la possibilità di vendere o trovare un prodotto.

### Scopo

  Lo scopo di questo progetto è di sviuppare una piattaforma web sulla quale si ha
  la possibilità di pubblicare delle richieste o delle offerte riguardanti le api
  dove gli utenti vengono informati quando la loro richiesta trova un offerta. Gli utenti vengono messi in contatto solamente se le loro richieste e le
  rispettive offerte si trovano all'interno dello stesso distretto e se le tipologie di richiesta e vendita corrispondono. Infatti ci sono tre tipi di
  prodotti che posssono essere venduti sulla piattaforma:

  - Famiglia di api
  
  - Nucleo di api

  - Ape regina

## Analisi

### Analisi del dominio

  Questo capitolo dovrebbe descrivere il contesto in cui il prodotto verrà
  utilizzato, da questa analisi dovrebbero scaturire le risposte a quesiti
  quali ad esempio:

  -   Background/Situazione iniziale

  Attualmente in Svizzera non è ancora stato sviluppata una piattaforma web sulla quale si possa commerciare Api all'interno dello stesso distretto. <br>
  Questo progetto nasce da una mancanza fondamentale, non esiste ancora un luogo comune dove gli apicoltori possano comunicare e commerciare le loro api.
  Questo progetto di fatto risolve questa lacuna, infatti è una piattaforma simile a [tutti.ch](https://www.tutti.ch/it) dove al posto degli oggetti comuni si possono commerciare
  esclusivamente api. È simile a tutti.ch ma questo progetto apporta un upgrade fondamentale alla piattaforma di commercio tra privati perché fino ad ora sulla piattaforma
  tutti.ch molti venditori e acquirenti non riescono a trovarsi e decidono di abbandonare la ricerca del prodotto o la vendita.<br>
  Questo progetto lo migliora perché quando una richiesta trova un'offerta valida queste persone vengono informate via email.

  -   Quale è e come è organizzato il contesto in cui il prodotto dovrà
      funzionare?

  -   Come viene risolto attualmente il problema? Esiste già un prodotto
      simile?

  Attualmente questo progetto rappresenta un prodotto unico mai sviluppato in precendenza.

  -   Chi sono gli utenti? Che bisogni hanno? Come e dove lavorano?

  Sul web questo progetto rappresenta l'unica piattaforma web per mettere in contatto gli apicoltori. Gli apicoltori secondo me hanno necessità di comunicare<br>
  per poter commerciare le loro api, senza questa piattaforma è difficile riuscire a vendere le api, soprattutto su tutti.ch dove rappresentano una minoranza.

  -   Che competenze/conoscenze/cultura posseggono gli utenti in relazione
      con il problema?

  Questa è una piattaforma destinata esclusivamente a degli apicoltori o a dei futuri apicolori, infatti la piattaforma segue le norme legali<br>
  per quanto riguarda la vendità all'interno dello stesso distretto. Altrimenti servirebbero dei permessi speciale.<br>
  Di fatto questa piattaforma evita problemi legali sia a persone nuove del mestiere che a persone esperte ma magari non a conoscenza di alcune leggi sulla tutela delle api.

  -   Esistono convenzioni/standard applicati nel dominio?

  -   Che conoscenze teoriche bisogna avere/acquisire per poter operare
      efficacemente nel dominio?

  La piattaforma fornisce ai novizi una sezione con dei link per impare tutto quello che riguarda le api e il loro commercio, questo per permettere alle nuove persone<br>
  di giostrarsi in modo efficace  all'interno di questo mercato per molti sconosciuto.

### Analisi e specifica dei requisiti

  |**ID**	|**Nome**			|**Priorità**|**Versione**|**Note**  |
  |----|------------|--------|----|------|
  | Req-001 | Pagina principale | 1 | 1.0 | Dovrà esserci una pagina principale dove saranno visibili tutte le inserzioni |
  | Req-002 | Pagina iscrizione | 1 | 1.0 | Dovra esserci una pagina di iscrizione con nome, cognome, nome utente, email, password e conferma password |
  | Req-003 | Pagina di login | 1 | 1.0 | Dovrà esserci una pagina di login con nome utente e password |
  | Req-004 | Pagina di profilo | 1 | 1.0 | Dovrà esserci una pagina di profilo dove potranno essere visualizzate le informazione personali come nome, cognome, nome utente. si dovranno anche visualizzare le inserzioni create dall'utente con la possibilità di rimuoverle. Bisogna avere la possibilità di cambiare l'indirizzo e-mail, e l'indirizzo |
  | Req-006 | Pagina di creazione delle inserzioni | 1 | 1.0 | Dovrà esserci una pagina dove si potranno creare delle inserzioni. Bisogna chiedere il nome per l'inserzione, una descrizione di quello che si vuole o si offre, che prodotto si cerca o vende (Famiglia di api, Nucleo di api o Api regine)
  | Req-007 | Pagina di match | 1 | 1.0 | Dovrà esserci una pagina dove verranno mostrati i match tra le rechieste o le offerte fatte dall'utente con le altre persone che cercano o vendono quello specifico prodotto |
  | Req-008 | Match nello stesso distretto | 1 | 1.0 | I match tra offerte e richieste dovranno essere fatte esclusivamente all'interno dello stesso distretto |
  | Req-009 | Controlli sulla password | 1 | 1.0 | Dovranno esserci i seguenti controlli per la creazione della password: lunga >= 8 caratteri <= 30 caratteri, dovrà avere almeno 1 carattere maiuscolo, 1 minuscolo e 1 carattere speciale |
  | Req-010 | Filtri pagina principale | 1 | 1.0 | Devono essere presenti dei filtri in base alla tipologia (richiesta, offerta), al prodotto (Famiglia di api, Nucleo di api o Api regine) e al distretto (Bellinzona, Blenio, Leventina, Locarno, Lugano, Mendrisio, Riviera, Vallemaggia) |
  | Req-011 | Chat tra acquirente e venditore | 1 | 1.0 | Se possibile dovrà essere presente una pagina, nella quale in base ai match si potrà parlare con l'acquirente o con il venditore del prodotto |
  | Req-012 | Conferma di vendita | 1 | 1.0 | Durante il match acquirenti e venditori possono confermare lo scambio tramite due bottoni di conferma. Se entrambi confermano lo scambio l'inserzione viene rimossa automaticamente |
  
**Spiegazione elementi tabella dei requisiti:**

**ID**: identificativo univoco del requisito

**Nome**: breve descrizione del requisito

**Priorità**: indica l’importanza di un requisito nell’insieme del
progetto, definita assieme al committente.

**Versione**: indica la versione del requisito. Ogni modifica del
requisito avrà una versione aggiornata.

Sulla documentazione apparirà solamente l’ultima versione, mentre le
vecchie dovranno essere inserite nei diari.

**Note**: eventuali osservazioni importanti o riferimenti ad altri
requisiti.

### Use case

I casi d’uso rappresentano l’interazione tra i vari attori e le
funzionalità del prodotto.

### Pianificazione

Prima di stabilire una pianificazione bisogna avere almeno una vaga idea
del modello di sviluppo che si intende adottare. In questa sezione
bisognerà inserire il modello concettuale di sviluppo che si seguirà
durante il progetto. Gli elementi di riferimento per una buona
pianificazione derivano da una scomposizione top-down della problematica
del progetto.

La pianificazione può essere rappresentata mediante un diagramma di
Gantt.

Se si usano altri metodi di pianificazione (es scrum), dovranno apparire
in questo capitolo.

### Analisi dei mezzi

Elencare e *descrivere* i mezzi disponibili per la realizzazione del
progetto. Ricordarsi di sempre descrivere nel dettaglio le versioni e il
modello di riferimento.

SDK, librerie, tools utilizzati per la realizzazione del progetto e
eventuali dipendenze.

Su quale piattaforma dovrà essere eseguito il prodotto? Che hardware
particolare è coinvolto nel progetto? Che particolarità e limitazioni
presenta? Che hw sarà disponibile durante lo sviluppo?

## Progettazione

Questo capitolo descrive esaustivamente come deve essere realizzato il
prodotto fin nei suoi dettagli. Una buona progettazione permette
all’esecutore di evitare fraintendimenti e imprecisioni
nell’implementazione del prodotto.

![Index](Progettazione/index.png)

### Pagina principale

La pagina principale permette a chiunque di vedere le inserzioni pubblicate dagli utenti. Un ospite può registrarsi<br>
per poter creare richieste, offerte guardare il suo profilo e può instaurare un dialogo con gli altri utenti del servizio.<br>
Gli utenti possono comunicare per email oppure tramite la chat integrata nel sito dove si comunica circa la richiesta e l'offerta.<br>
Per poter accedere alle pagine di aggiunta delle inserszioni, chat e il match l'utente deve eseguire il [login](#pagina-di-login) premendo l'icona rappresentante una persona.<br>
Se l'utente non ha ancora un profilo può [iscriversi](#pagina-di-registrazione) premendo il pulsante iscriviti.<br>
L'utente, nella pagina principale, può decidere di filtrare i risultati utilizzando due criteri:
  - Tipi di prodotto: Famiglia di api, Nucleo di api e Api regine
  - Distretti: Locarnese, Bellinzonese, Blenio, Leventina, Riviera, Vallemaggia, Luganese e Mendrisiotto

![Registrazione](Progettazione/registrazione.png)

### Pagina di registrazione

La pagina di registrazione permette all'utente di creare un nuovo profilo.<br>
Tutti i campi compilabili sono obbligatori e se non vengono riempiti compare il mesaggio "Compilare tutti i campi per continuare".<br>
La password è complessa e se la password non soddisfa i requisiti minimi compare il messaggio "La password non soddisfa i requisiti minimi di sicurezza".<br>
Se la password inserita non corrisponde alla password di verifica compare il messaggio "La due password non corrispondono".

![Login](Progettazione/login.png)

### Pagina di login

La pagina di login permette all'utente di collegarsi con il suo profilo utente.<br> 
Se l'utente inserisce il nome utente oppure la password non sbagliate viene mostrato il messaggio "Nome utente o password non corretti". 

![Profilo](Progettazione/profilo.png)

### Pagina di profilo

Nella pagina di profilo l'utente può visualizzare le sue informazioni personali,<br>
può cambiare il suo indirizzo E-Mail e può vedere le sue inserzioni per eliminarle.

![Match](Progettazione/match.png)

### Pagina di match

La pagina di match permette ad un utente registrato di vedere le **possibili** combinazioni tra la loro richiesta e le offerte disponibili con il servizio.<br>
Un utente può decidere se accettare o rifiutare un'offerta / richiesta. Se il match viene confermata all'interno nella sezione [chat](#pagina-della-chat) del sito.

![Chat](Progettazione/chat.png)

### Pagina della chat

La pagina della chat permette ad acquirenti e venditori di aver un dialogo circa il prodotto in offerta o il prodotto ricercato.<br>
Quando l'affare è concluso la chat viene eliminata in automatico.

### Design dell’architettura del sistema

![Architettura di rete](Progettazione/architettura_rete.png)

### Design dei dati e database

Descrizione delle strutture di dati utilizzate dal programma in base
agli attributi e le relazioni degli oggetti in uso.

### Schema E-R, schema logico e descrizione.

![Struttura del database](Progettazione/struttura_database.png)

### Design delle interfacce

Descrizione delle interfacce interne ed esterne del sistema e
dell’interfaccia utente. La progettazione delle interfacce è basata
sulle informazioni ricavate durante la fase di analisi e realizzata
tramite mockups.

### Design procedurale

Descrive i concetti dettagliati dell’architettura/sviluppo utilizzando
ad esempio:

-   Diagrammi di flusso e Nassi.

-   Tabelle.

-   Classi e metodi.

-   Tabelle di routing

-   Diritti di accesso a condivisioni …

Questi documenti permetteranno di rappresentare i dettagli procedurali
per la realizzazione del prodotto.

## Implementazione

In questo capitolo dovrà essere mostrato come è stato realizzato il
lavoro. Questa parte può differenziarsi dalla progettazione in quanto il
risultato ottenuto non per forza può essere come era stato progettato.

Sulla base di queste informazioni il lavoro svolto dovrà essere
riproducibile.

In questa parte è richiesto l’inserimento di codice sorgente/print
screen di maschere solamente per quei passaggi particolarmente
significativi e/o critici.

Inoltre dovranno essere descritte eventuali varianti di soluzione o
scelte di prodotti con motivazione delle scelte.

Non deve apparire nessuna forma di guida d’uso di librerie o di
componenti utilizzati. Eventualmente questa va allegata.

Per eventuali dettagli si possono inserire riferimenti ai diari.

## Test

### Protocollo di test

Definire in modo accurato tutti i test che devono essere realizzati per
garantire l’adempimento delle richieste formulate nei requisiti. I test
fungono da garanzia di qualità del prodotto. Ogni test deve essere
ripetibile alle stesse condizioni.


|Test Case      | TC-001                               |
|---------------|--------------------------------------|
|**Nome**       |Import a card, but not shown with the GUI |
|**Riferimento**|REQ-012                               |
|**Descrizione**|Import a card with KIC, KID and KIK keys with no obfuscation, but not shown with the GUI |
|**Prerequisiti**|Store on local PC: Profile\_1.2.001.xml (appendix n\_n) and Cards\_1.2.001.txt (appendix n\_n) |
|**Procedura**     | - Go to “Cards manager” menu, in main page click “Import Profiles” link, Select the “1.2.001.xml” file, Import the Profile - Go to “Cards manager” menu, in main page click “Import Cards” link, Select the “1.2.001.txt” file, Delete the cards, Select the “1.2.001.txt” file, Import the cards |
|**Risultati attesi** |Keys visible in the DB (OtaCardKey) but not visible in the GUI (Card details) |


### Risultati test

Tabella riassuntiva in cui si inseriscono i test riusciti e non del
prodotto finale. Se un test non riesce e viene corretto l’errore, questo
dovrà risultare nel documento finale come riuscito (la procedura della
correzione apparirà nel diario), altrimenti dovrà essere descritto
l’errore con eventuali ipotesi di correzione.

### Mancanze/limitazioni conosciute

Descrizione con motivazione di eventuali elementi mancanti o non
completamente implementati, al di fuori dei test case. Non devono essere
riportati gli errori e i problemi riscontrati e poi risolti durante il
progetto.

## Consuntivo

Consuntivo del tempo di lavoro effettivo e considerazioni riguardo le
differenze rispetto alla pianificazione (cap 1.7) (ad esempio Gannt
consuntivo).

## Conclusioni

Quali sono le implicazioni della mia soluzione? Che impatto avrà?
Cambierà il mondo? È un successo importante? È solo un’aggiunta
marginale o è semplicemente servita per scoprire che questo percorso è
stato una perdita di tempo? I risultati ottenuti sono generali,
facilmente generalizzabili o sono specifici di un caso particolare? ecc

### Sviluppi futuri
  Migliorie o estensioni che possono essere sviluppate sul prodotto.

### Considerazioni personali
  Cosa ho imparato in questo progetto? ecc

## Bibliografia

### Bibliografia per articoli di riviste
1.  Cognome e nome (o iniziali) dell’autore o degli autori, o nome
    dell’organizzazione,

2.  Titolo dell’articolo (tra virgolette),

3.  Titolo della rivista (in italico),

4.  Anno e numero

5.  Pagina iniziale dell’articolo,

### Bibliografia per libri


1.  Cognome e nome (o iniziali) dell’autore o degli autori, o nome
    dell’organizzazione,

2.  Titolo del libro (in italico),

3.  ev. Numero di edizione,

4.  Nome dell’editore,

5.  Anno di pubblicazione,

6.  ISBN.

### Sitografia

1.  URL del sito (se troppo lungo solo dominio, evt completo nel
    diario),

2.  Eventuale titolo della pagina (in italico),

3.  Data di consultazione (GG-MM-AAAA).

**Esempio:**

-   http://standards.ieee.org/guides/style/section7.html, *IEEE
    Standards Style Manual*, 07-06-2008.

## Allegati

Elenco degli allegati, esempio:

-   Diari di lavoro

-   Codici sorgente/documentazione macchine virtuali

-   Istruzioni di installazione del prodotto (con credenziali
    di accesso) e/o di eventuali prodotti terzi

-   Documentazione di prodotti di terzi

-   Eventuali guide utente / Manuali di utilizzo

-   Mandato e/o Qdc

-   Prodotto

-   …