
Ho seguito un corso e ho studiato un po' di Laravel ed ho provato a sporcarmi le mani.
Il risultato è un backend di demo che risponde in formato json, ci sono delle parti da completare,  da modificare, e correggere.
Cosi come è non utilizzabile, è un caso studio per prendere dimestichezza con Laravel.  <br />
Nei files che ho modificato dento backend/src si trova la stringa "** DEMO-LARAVEL **"
Credo che possa far intravedere le potenzialità di Laravel e la semplicità del codice che si utilizza con esso,
io ne sono rimasto piacevolmente impressionato.

Per tutti gli approfondimenti https://laravel.com/

# Prerequisiti
- Docker*
- Editor per il Php
- Postman (Per semplificare i test con le chiamate)
- Competenze su php, mysql e docker

# Versioni per ambiente di sviluppo locale dockerizzato
Backend:
    Immagine base docker: php:8.1-apache <br />
    DockerHub: https://hub.docker.com/layers/library/php/8.1-apache/images/sha256-b1b1f60daa52840cafee2d643870f6c0b1826f24eead6cd4d1f05c1f34ae3553?context=explore <br />
    Dockerfile: ./docker-files/backend/Dockerfile (se volete customizzare cucinarla con il comando di esempio su docs/comandi-utili.txt) <br />
    Remota: https://hub.docker.com/r/rpinna78/demo-laravel (attualmente nel docker-compose.yml)<br />
    Laravel 9:9.4.0<br />

DB:<br />
    Immagine base docker: mysql:5.7<br />
    DockerHub: https://hub.docker.com/layers/library/mysql/5.7/images/sha256-bd0fb5a175fc225ce9c2c4357c0f532bda1413e0b8555a157770f92daa5a89e0?context=explore<br />
  
Phpmyadmin: <br />
    Immagine base docker: phpmyadmin/phpmyadmin:latest<br />
    DockerHub: https://hub.docker.com/layers/library/phpmyadmin/latest/images/sha256-6f215175b0f232b5fe8b62397dd27b5d98c583860b3fd0c083805a0215f93b24?context=explore<br />

Ho raccolto alcuni comandi utili sono sotto docs/comandi-utili.txt<br />

# Far girare il sito in locale
Configurare nel file hosts del proprio pc (divesamente utilizzare localhost): <br />
Per esempio:<br />
127.0.0.1 demo.laravel.local<br />
127.0.0.1 phpmyadmin.demo.laravel.local<br />
127.0.0.1 mysql.demo.laravel.local<br />

Backend<br />
    http://demo.laravel.local:8080<br />
Mysql<br />
    http://mysql.demo.laravel.local:3306<br />
Phpmyadmin**<br />
    http://phpmyadmin.demo.laravel.local:8081<br />

Le porte del pc esposte sono configurabili nel docker-compose.yml<br />

# Setup Sito Locale<br />
Gli Env sono configurabili nel file local.env ( che allo stato attuale comprende le credenziali del database)<br />
**** IMPORTANTE **************************************************************************<br />
Tramite il local.env puoi settare gli env del .env di Laravel del progetto demo-laravel<br />
*****************************************************************************************<br />
1 - Up del docker (docker-compose up -d)<br />
2 - Init del Database<br />
    A) entrare sul terminale di demobackend<br />
    B) php artisan migrate <br />
3 - Aprire Postman <br />
4 - Importare su Postaman la collection (postman/demo-laravel.postman_collection.json)<br />
5 - Importare su Postaman gli env (postman/demo-laravel.postman_environment.json) ed utilizzarli<br />
6 - creare il primo utente di prova con postman<br />
La api è auth/register chiamarla e copiare il token della risposta<br />
7 - Settare token utente aggiornato tra gli env demo-laravel<br />

# Start Ambiente Locale<br />
1 - Up del docker (docker-compose up -d)<br />

# Down Ambiente Locale<br />
1 - Down del docker (docker-compose down)<br />


*****************************************************************************<br />
***     Asterischi **********************************************************<br />
*****************************************************************************<br />

* Se dovessi avere dei problemi docker con la wsl soto win leggi questa guida<br />
https://docs.microsoft.com/it-it/windows/wsl/install-win10#step-4---download-the-linux-kernel-update-package<br />
Procedura di installazione manuale<br />
Eseguire i punti dal punto 1  al punto 5<br />

** Non indispensabile, ma utile se non si ha un client myql installato in locale<br />

