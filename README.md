# The Aulab Post – Progetto Finale  
**Autore:** Luzzi Giuseppe  

The Aulab Post è il progetto finale sviluppato per il corso Full Stack di Aulab.  
Si tratta di una piattaforma di pubblicazione articoli con ruoli utente avanzati,  
sistema di revisione, approvazione contenuti e area amministrativa.

---

##  Funzionalità principali

###  Area Utente
- Registrazione e login tramite Laravel Breeze  
- Creazione, modifica ed eliminazione articoli  
- Caricamento immagine articolo  
- Panel personale con i propri contenuti  
- Possibilità di inviare una richiesta per diventare revisore  

---

##  Ruolo Revisore
- Accesso dedicato alla dashboard del revisore  
- Visualizzazione degli articoli in attesa  
- Possibilità di:
  - Accettare l’articolo  
  -  Rifiutare l’articolo  

Solo dopo l'approvazione un articolo diventa pubblico sul sito.

---

##  Ruolo Admin
- Accesso all’area Admin Panel  
- Gestione delle richieste dei nuovi revisori  
- Possibilità di approvare o rifiutare le richieste  
- Controllo generale della piattaforma  

---

##  Struttura del progetto
Il progetto segue l’architettura MVC di Laravel:
- **Models:** User, Article  
- **Controllers:** Public, Article, Revisor, Admin  
- **Middleware:** isAdmin, isRevisor  
- **Migrazioni:** gestione utenti, ruoli, articoli  
- **Blade Components:** layout, navbar  

---

##  Tecnologie utilizzate
- **Laravel 10 / PHP 8**  
- **Laravel Breeze** (autenticazione)  
- **MySQL**  
- **Bootstrap 5**  
- **Vite** per la gestione degli asset  

---

##  Installazione (se necessario)
Clona la repository e installa le dipendenze:

```bash
composer install
npm install
npm run build
