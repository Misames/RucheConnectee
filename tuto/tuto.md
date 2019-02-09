# Tuto

## Préambule

je vous conseille de vous renseigner sur tout les outils commme linux avec toute les commande plus les editeurs de texte et apprendre Les langages SQL, Python et php

je vous recommande de regarder les tutos indiquer pour savoir quelle commande utiliser

    - Se munir de tout le matériel minimum
    - installation de tout les outils
        1) Etcher
        2) Crée la Carte SD bootable
        3) mettre la Carte SD et Lancé le raspberry
        4) Configurer l'OS, le mettre à jour, et installer les
        outil qui permetrons de developper avec 'apt get install'
        apache2, mysql, php, phpmyadmin, python, raspAP, vim.
        5) Il faudra installer pour mon projet la librairie
        'pymysql'(Pour faire des reqquête SQL dans le script) et
        'Serial'(Pour communiquer avec l'arduino par USB)
    - Quand vous auraient fini d'installer tout les outils.
    pip
    pyserial
    pymysql
    Vous pouraient commencer à developper votre script ou votre site web  

| **Logiciel** |
|---|

[Etcher](https://etcher.io/) avec le [tuto](https://www.framboise314.fr/installation-de-raspbian-pour-le-raspberry-pi-sur-carte-micro-sd-avec-etcher/)

[Raspbian](https://raspbian-france.fr/telechargements/)

[Serveur web](https://www.google.fr/search?q=serveur+web&rlz=1C1CHBF_frFR810FR811&oq=serveur+web+&aqs=chrome..69i57j69i60j0l4.4090j0j7&sourceid=chrome&ie=UTF-8) avec le [tuto](https://www.framboise314.fr/installation-de-raspbian-pour-le-raspberry-pi-sur-carte-micro-sd-avec-etcher/)

[HotSpot Wifi](https://www.google.fr/search?q=hotspot+wifi+raspberry&rlz=1C1CHBF_frFR810FR811&oq=hotspot+wifi+&aqs=chrome.0.69i59j0j69i57j0l3.5718j0j7&sourceid=chrome&ie=UTF-8) avec le [tuto](https://raspbian-france.fr/creer-un-hotspot-wi-fi-en-moins-de-10-minutes-avec-la-raspberry-pi/)

| **Commandes Linux** | **Description** |
|---| --- |
| `sudo su` | Donne tout les droits admin quand on est connecté |
| `aptitude-update`| lance le télécgarement de toutes les mis à jour |
| `aptitude-upgrade`| lance l'installation de toute les mise à jour |
| `apt-update`| lance le télécgarement de toutes les mis à jour |
| `apt-upgrade`| lance l'installation de toute les mise à jour |
| `apt-get 'nom d'un logiciel'`| commande pour installer un logiciel dans le repo distant de debian |

## Liste des outils

| **Nom** | **Type** | **Description** |
| --- | :---: | :---: |
| `Raspbian` | `OS` | `Système d'exploitation sur la machine sous LINUX basé sur Bash` |
| `Apache` | `Serveur HTTP` | `le serveur web` |
| `MySQL` | `SGBD` | `Système de gestion de base de données` |
| `PHPMyAdmin` | `interface` | `Permet d'utiliser MySQL pour géré la baase de donnée` |
| `PHP` | `Langage` | `langage interpréter orienté objet et gère les bases de donné nativement` |
| `Python` | `langage` | `Orienté objet` |
| `SSH` | `Service` | `Protocol de control à distance via en ligne de commande` |
| `VNC` | `Service` | `Protocole de control à distance image en direct du pc sous control` |
| `RaspAP` | `Service` | `outil pour administré un hotspot WiFI` |
| `Vi ou VIM ou Nano` | `Editeur de texte` | `ce son des editeur de text dans l'invite de commande donc pas d'interface graphique` |