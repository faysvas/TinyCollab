# TinyCollab

To TinyCollab είναι ένας συνεργατικός επεξεργαστής κειμένου όπου δύο ή παραπάνω χρήστες μπορούν να κάνουν αλλαγές σε πραγματικό χρόνο και να επικοινωνούν μεταξύ τους μέσω chat.
Ο συγχρονισμός των χρηστών γίνεται με το sock.js, μία βιβλιοθήκη javascript που προσμοιάζει τη λειτουργία των websockets. 
Η διαχείριση των λογαριασμών των χρηστών γίνεται από το usercake. 


Οδηγίες εγκατάστασης
1.Κάνετε τις κατάλληλες ρυθμίσεις για τη βάση δεδομένων στο αρχείο usercake/models/db-settings.php
2.Δώστε το φάκελο που θέλετε να αποθηκεύονται τα αρχεία των χρηστών στο αρχείο usercake/models/db-settings.php 
3.Τρέξτε το αρχειο install/index.php και διαγράψτε το μετά την εγκατάσταση. 
4.Πηγαίνετε στο φάκελο sockjs-server και εγκαταστήστε το sock.js για το συγχρονισμό των χρηστών. 

$ npm install sockjs
$ node server.js

(Απαραίτητη προϋπόθεση για αυτό το βήμα είναι να έχετε εγκατεστημένο το node.js)