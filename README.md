
Ho seguito un corso e ho studiato un po' di Laravel ed ho provato a sporcarmi le mani.
Il risultato è un backend di demo che risponde in formato json, ci sono delle parti da completare,  da modificare, e correggere.
Cosi come è non utilizzabile, è un caso studio per prendere dimestichezza con Laravel.
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
    Immagine base docker: php:8.1-apache
    DockerHub: https://hub.docker.com/layers/library/php/8.1-apache/images/sha256-b1b1f60daa52840cafee2d643870f6c0b1826f24eead6cd4d1f05c1f34ae3553?context=explore
    Dockerfile: ./docker-files/backend/Dockerfile (se volete customizzare cucinarla con il comando di esempio su docs/comandi-utili.txt)
    Remota: https://hub.docker.com/r/rpinna78/demo-laravel (attualmente nel docker-compose.yml)
    Laravel 9:9.4.0

DB:
    Immagine base docker: mysql:5.7
    DockerHub: https://hub.docker.com/layers/library/mysql/5.7/images/sha256-bd0fb5a175fc225ce9c2c4357c0f532bda1413e0b8555a157770f92daa5a89e0?context=explore
  
Phpmyadmin: 
    Immagine base docker: phpmyadmin/phpmyadmin:latest
    DockerHub: https://hub.docker.com/layers/library/phpmyadmin/latest/images/sha256-6f215175b0f232b5fe8b62397dd27b5d98c583860b3fd0c083805a0215f93b24?context=explore

Ho raccolto alcuni comandi utili sono sotto docs/comandi-utili.txt

# Far girare il sito in locale
Configurare nel file hosts del proprio pc (divesamente utilizzare localhost):
Per esempio:
127.0.0.1 demo.laravel.local
127.0.0.1 phpmyadmin.demo.laravel.local
127.0.0.1 mysql.demo.laravel.local

Backend
    http://demo.laravel.local:8080
Mysql
    http://mysql.demo.laravel.local:3306
Phpmyadmin**
    http://phpmyadmin.demo.laravel.local:8081

Le porte del pc esposte sono configurabili nel docker-compose.yml

# Setup Sito Locale
Gli Env sono configurabili nel file local.env ( che allo stato attuale comprende le credenziali del database)
**** IMPORTANTE **************************************************************************
Tramite il local.env puoi settare gli env del .env di Laravel del progetto demo-laravel
*****************************************************************************************
1 - Up del docker (docker-compose up -d)
2 - Init del Database
    A) entrare sul terminale di demobackend
    B) php artisan migrate 
3 - Aprire Postman 
4 - Importare su Postaman la collection (postman/demo-laravel.postman_collection.json)
5 - Importare su Postaman gli env (postman/demo-laravel.postman_environment.json) ed utilizzarli
6 - creare il primo utente di prova con postman
La api è auth/register chiamarla e copiare il token della risposta
7 - Settare token utente aggiornato tra gli env demo-laravel

# Start Ambiente Locale
1 - Up del docker (docker-compose up -d)

# Down Ambiente Locale
1 - Down del docker (docker-compose down)


*****************************************************************************
***     Asterischi **********************************************************
*****************************************************************************

* Se dovessi avere dei problemi docker con la wsl soto win leggi questa guida
https://docs.microsoft.com/it-it/windows/wsl/install-win10#step-4---download-the-linux-kernel-update-package
Procedura di installazione manuale
Eseguire i punti dal punto 1  al punto 5

** Non indispensabile, ma utile se non si ha un client myql installato in locale

