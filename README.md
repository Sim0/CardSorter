CardsSorter App
===============

Solution d'un exercice de tri de carte en symfony.  
Le tri se fait sur un jeu de carte (10) en respectant un ordre de valeurs et un ordre de couleurs donnés.  

Pré-requis:
===========
 > PHP 5.5.9 +  
 > ext-curl
 
 CURL configuration : http://php.net/manual/fr/curl.configuration.php  
 > if﻿curl.cainfo is not set a similar error while occur :  
 ﻿Fatal error: Uncaught exception 'cURL_Exception' with message 'cURL resource: Resource id #10; cURL error: SSL certificate problem: unable to get local issuer certificate (cURL error code 60). See http://curl.haxx.se/libcurl/c/libcurl-errors.html  
 - Use this certificate root certificate bundle:  
 https://curl.haxx.se/ca/cacert.pem  
 - Copy this certificate bundle on your disk. And use this on php.ini  
 curl.cainfo = "path_to_cert\cacert.pem"  
 (https://stackoverflow.com/questions/21114371/php-curl-error-code-60)

Pré-requis de Symfony 3  : https://symfony.com/doc/3.4/reference/requirements.html  
Pré-requis de GuzzleHttp : http://docs.guzzlephp.org/en/stable/overview.html#requirements  

Utilisation:
============
Récupérer le code source
  > git clone git@github.com:Sim0/CardSorter.git  
  > cd CardSorter/

Créer le fichier parameters.yml du projet symfony
  > cp app/config/parameters.yml.dist app/config/parameters.yml

Lancer le serveur PHP (PHP built-in web server) par défaut sur http://127.0.0.1:8000
  > php bin/console server:run --env=prod

La page [/]() affiche 4 blocks:
  - Original Response : La réponse originale récupérée via la méthode GET.
  - Challenge : Les cartes non triées avec les ordres value et category.
  - Solution : Les cartes triées par l'application.
  - Result : Le résultat de la solution si elle est correcte ou non.


Structure:
==========
 > Adapter  
    - interface DataComInterface  
    - class  GuzzleAdapter  
 > DataTransformer  
    - class CardResponseFormatter  
 > Domain  
    - class Card  
    - class CardBox  
    - class CardBoxSorter  
    - class CardComparer  
    - interface ComparerInterface  
 > Factory  
    - class CardBoxFactory  
