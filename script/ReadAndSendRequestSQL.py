#!/usr/bin/env python
# -*- coding: latin-1 -*-

# on import les fonctionnalités et bibliothèques dont on a besoin pour traiter les informations

import serial
import sys
import time
import pymysql.cursors

# Connexion à la base de données

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='projetRuche',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

# initialisation des variables"

nb_abeille = 10000
message_alert = 0
mass_miel = 00.00
temp_ext = 00.00
temp_int = 00.00
temp_max = 00.00
temp_min = 00.00
humi_ext = 00.00
humi_int = 00.00
humi_min = 00.00
humi_max = 00.00

compteur_serial = 0
compteur = 0

date = time.strftime("%d %H") # fonction pour avoir le jour actuel et l'heure
# ser = serial.Serial( port='/dev/ttyACM0', baudrate = 9600) # fonction pour lire le port série
mon_fichier = open("test.txt", "r") # fichier de test
try:
    with connection.cursor() as cursor:
    
        # création de la table 
        print("Verification ... fait a " , date)

        time.sleep(3)
        sql = "CREATE TABLE IF NOT EXISTS `Ruche` (`id` int(255) NOT NULL AUTO_INCREMENT, `nb_abeille` int(255) COLLATE utf8_bin NOT NULL,`mass_miel` float(22) COLLATE utf8_bin NOT NULL,`message_alert` int(255) COLLATE utf8_bin NOT NULL, `temp_int` float(22) COLLATE utf8_bin NOT NULL, `temp_ext` float(22) COLLATE utf8_bin NOT NULL,`temp_min` float(22) COLLATE utf8_bin NOT NULL,`temp_max` float(22) COLLATE utf8_bin NOT NULL,`humi_int` float(22) COLLATE utf8_bin NOT NULL, `humi_ext` float(22) COLLATE utf8_bin NOT NULL,`humi_min` float(22) COLLATE utf8_bin NOT NULL,`humi_max` float(22) COLLATE utf8_bin NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1"
        cursor.execute(sql)
    
    connection.commit() #Commit

finally:
    print('Verification terminee.')

while 1:
    while compteur_serial == 0:
            for ligne in mon_fichier: # on lit ligne par ligne le port série
                if "nombre d'abeille" in ligne: # si on  lit "nombre d'abeille" dans le port série on le découpe mot par mot puis on prend la ligne qui nous intéresse 
                    line = ligne.split()
                    print("nombre d'abeille =",line[-1])
                    nb_abeille = line[-1]
                if "masse de miel" in ligne: 
                    line = ligne.split()
                    print("masse de miel =",line[-2])
                    mass_miel = line[-2]
                if "alert" in ligne: 
                    line = ligne.split()
                    print("alert =",line[-1])
                    message_alert = line[-1]
                if "temperature interieure" in ligne: 
                    line = ligne.split()
                    print("temperature interieure =",line[-2])
                    temp_int = line[-2]
                if "temperature exterieure" in ligne: 
                    line = ligne.split()
                    print("temperature exterieure =",line[-2])
                    temp_ext = line[-2]
                if "temperature minimum" in ligne: 
                    line = ligne.split()
                    print("temperature minimum =",line[-2])
                    temp_min = line[-2]
                if "temperature maximum" in ligne: 
                    line = ligne.split()
                    print("temperature maximum =",line[-2])
                    temp_max = line[-2]
                if "humidite interieure" in ligne: 
                    line = ligne.split()
                    print("humidite interieure =",line[-2])
                    humi_int = line[-2]
                if "humidite exterieure" in ligne: 
                    line = ligne.split()
                    print("humidite exterieure =",line[-2])
                    humi_ext = line[-2]
                if "humidite minimum" in ligne: 
                    line = ligne.split()
                    print("humiditer minimum =",line[-2])
                    humi_min = line[-2]
                if "humidite maximum" in ligne: 
                    line = ligne.split()
                    print("humidite maximum =",line[-2])
                    humi_max = line[-2]
                if "fini" in ligne: 
                    compteur_serial = 1
                    print("Fin de la lecture.")
                    break
            try:
                with connection.cursor() as cursor:
                    date = time.strftime("%d %H")
                    dateComplete = time.strftime("%A %d %B %Y %H:%M:%S")
                    
                    if date == '30 02':   # reset de la base de données le 31 du mois à 2h du matin et pendant une heure bloc le système
                        sql = "TRUNCATE TABLE `Ruche`"
                        cursor.execute(sql) #Execution
                        print("Table purgee a ", date)
                        print("Chargement de la nouvelle table ...")
                        time.sleep(3600)
                        compteur = 0
                        connection.commit() #Commit
                        
                    # On execute une requête SQL pour ajouter des données à la BDD
                    sql = "INSERT INTO `Ruche` (`nb_abeille`, `mass_miel`, `message_alert`,  `temp_int`, `temp_ext`, `temp_min`, `temp_max` , `humi_int`, `humi_ext`, `humi_min`, `humi_max`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s ,%s, %s, %s)" # requête SQL pour mettre à jour la base de données après la Création et purge de celci juste avant si la condition est vérifé
                    cursor.execute(sql, (nb_abeille, mass_miel, message_alert, temp_int, temp_ext, temp_min, temp_max, humi_int, humi_ext, humi_min, humi_max)) #Execution
                    connection.commit() #Commit
                    print('Mise a jour des valeurs fini.')
                    time.sleep(5)
                    compteur += 1
                    print("Nombre de requetes actuellles = ", compteur ," le ", dateComplete)
                    time.sleep(1)
            finally:
                print('Finish.')
                compteur_serial = 0
                time.sleep(5)
connection.close()       
