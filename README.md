# TinyCollab

To TinyCollab είναι ένας συνεργατικός επεξεργαστής κειμένου όπου δύο ή παραπάνω χρήστες μπορούν να κάνουν αλλαγές σε πραγματικό χρόνο και να επικοινωνούν μεταξύ τους μέσω chat.
Ο συγχρονισμός των χρηστών γίνεται με το sock.js, μία βιβλιοθήκη javascript που προσoμοιάζει τη λειτουργία των websockets. 
Η διαχείριση των λογαριασμών των χρηστών γίνεται από το usercake.  

Το TinyCollab αναπτύχθηκε ως έργο συνεισφοράς για το 2ο σχολείο κώδικα της Μονάδας Αριστείας του Πανεπιστημίου Κρήτης που διεξήχθη από 08/07/2015 - 14/07/2015. 


## Οδηγίες εγκατάστασης

1. Κάνετε τις κατάλληλες ρυθμίσεις για τη βάση δεδομένων στο αρχείο usercake/models/db-settings.php
2. Δώστε το φάκελο που θέλετε να αποθηκεύονται τα αρχεία των χρηστών στο αρχείο usercake/models/config.php 
3. Τρέξτε το αρχειο install/index.php και διαγράψτε το μετά την εγκατάσταση. 
4. Πηγαίνετε στο φάκελο sockjs-server και εγκαταστήστε το sock.js για το συγχρονισμό των χρηστών με τις παρακάτω εντολές. 

```
$ npm install sockjs //Αυτό το βήμα χρειάζεται μόνο τη πρώτη φορά που 
$ node server.js     //κάνετε εγκατάσταση
```

(Απαραίτητη προϋπόθεση για αυτό το βήμα είναι να έχετε εγκατεστημένο το node.js)

## Πρόσθετες βιβλιοθήκες που έχουν χρησιμοποιηθεί
* [markItUp!](http://markitup.jaysalvat.com/home/) Universal markup jQuery editor
* [sock.js](https://github.com/sockjs) WebSocket emulation
* [usercake](http://usercake.com/) The fully open source user management script   

## Άδεια  
Άδεια χρήσης ΕΛ/ΛΑΚ: [Creative Commons Attribution 3.0 License](https://creativecommons.org/licenses/by/3.0/).  



