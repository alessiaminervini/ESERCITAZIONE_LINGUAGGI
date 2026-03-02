#  SmartFinance

SmartFinance è un'applicazione web per il tracciamento di entrate e uscite.

Il progetto integra:

- Configurazione tramite YAML
- Gestione dati tramite JSON
- Esportazione dati in XML
- Sistema di autenticazione con sessioni PHP
- API REST in formato JSON
- Utilizzo del Markdown per la documentazione

---

#  YAML – Configurazione Applicativa

File: `config/app.yaml`

Contiene:

- Nome applicazione
- Versione
- Ambiente (sviluppo / produzione)
- Feature flag (es. abilita_download_xml)
- Impostazioni export

Il file viene parsato in `dashboard.php`.

Le feature flag permettono di attivare o disattivare funzionalità senza modificare il codice sorgente.

---

#  JSON – Gestione Dati

File: `data/transazioni.json`

Ogni transazione contiene:

- username
- data
- descrizione
- importo

API: `api/transazioni.php`

Funzioni:

- Restituisce dati in formato JSON
- Filtra per utente autenticato
- Calcola saldo totale
- Gestisce eventuali errori HTTP

Frontend: `assets/script.js`

- Effettua chiamata fetch() verso l’API
- Parsea la risposta JSON
- Renderizza dinamicamente le transazioni
- Mostra saldo aggiornato

---

#  XML – Esportazione Estratto Conto

File:

- `data/estratto_conto.xml`
- `api/download_estratto.php`

Funzionalità:

- Generazione dinamica XML
- Inserimento DataGenerazione
- Download tramite header HTTP
- Esportazione strutturata delle transazioni

---

#  Database

File: `db/connessione.php`

Contiene:

- Configurazione connessione database
- Gestione errori
- Separazione logica database

Il database viene utilizzato per la gestione degli utenti autenticati.

---

#  Sistema di Autenticazione

Cartella: `auth/`

## register.php
- Validazione input utente
- Hash password con `password_hash()`
- Inserimento sicuro nel database

## login.php
- Verifica credenziali
- `password_verify()`
- Avvio sessione PHP
- Salvataggio id utente in `$_SESSION`
- Redirect alla dashboard

## logout.php
- Distruzione sessione
- Redirect alla pagina iniziale

---

#  Sicurezza Implementata

- Password salvate con hash crittografico
- Prepared statements contro SQL injection
- Gestione sessioni PHP
- Separazione file per responsabilità
- Validazione lato server

---

#  Ruoli del Team

## Fabio Arciuli – YAML
- Struttura `app.yaml`
- Parsing configurazione
- Gestione feature flag
- Ambiente sviluppo/produzione

## Paolo Garofoli – XML
- Struttura `estratto_conto.xml`
- Generazione in `download_estratto.php`
- Coerenza formale

## Miriam di Benedetto – JSON
- Struttura `transazioni.json`
- API `transazioni.php`
- script.js
- Calcolo saldo

## Alessia Minervini – Database + Autenticazione + Documentazione
- `connessione.php`
- Sistema login/register/logout
- Gestione sessioni
- Sicurezza password
- Documentazione README.md
