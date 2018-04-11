#!/usr/bin/env python
# -*- coding: latin-1 -*-

import serial
import sys
import time
import pymysql.cursors

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='ProjetRuche',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)
nbAbeille = 10000
message_alert = 1
mass_miel = 32.52
temp_ext = 60.54
temp_int = 56.26
temp_max = 40.45
temp_min = 15.54
humi_ext = 12.94
humi_int = 16.64
humi_min = 18.47
humi_max = 98.54

compteur = 0
date = time.strftime("%d %H")

try:
    with connection.cursor() as cursor:
    
        print("Verification ... faite a " , date)
        time.sleep(1)
        sql = "CREATE TABLE IF NOT EXISTS `Ruche` (`id` int(255) NOT NULL AUTO_INCREMENT, `nb_abeille` int(255) COLLATE utf8_bin NOT NULL,`mass_miel` float(22) COLLATE utf8_bin NOT NULL,`message_alert` int(255) COLLATE utf8_bin NOT NULL, `temp_int` float(22) COLLATE utf8_bin NOT NULL, `temp_ext` float(22) COLLATE utf8_bin NOT NULL,`temp_min` float(22) COLLATE utf8_bin NOT NULL,`temp_max` float(22) COLLATE utf8_bin NOT NULL,`humi_int` float(22) COLLATE utf8_bin NOT NULL, `humi_ext` float(22) COLLATE utf8_bin NOT NULL,`humi_min` float(22) COLLATE utf8_bin NOT NULL,`humi_max` float(22) COLLATE utf8_bin NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1" #Partie 2 de la requête (Accumulation des requêtes)
        cursor.execute(sql)
    
    connection.commit() #Commit

finally:
    
    print('Verification terminer.')
    
while 1:
    while 1:
        try:
            with connection.cursor() as cursor:
                date = time.strftime("%d %H")
                dateComplete = time.strftime("%A %d %B %Y %H:%M:%S")

                if date == '31 02':   # reset de la base de donnée le 31 du mois
                    sql = "TRUNCATE TABLE `Ruche`"
                    cursor.execute(sql) #Execution
                    print("Table purger a ", date)
                    print("Chargement de la nouvelle table ...")
                    time.sleep(3600)
                    compteur = 0
                    connection.commit() #Commit

                sql = "INSERT INTO `Ruche` (`nb_abeille`, `mass_miel`, `message_alert`,  `temp_int`, `temp_ext`, `temp_min`, `temp_max` , `humi_int`, `humi_ext`, `humi_min`, `humi_max`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s ,%s, %s, %s)" # requête SQL pour mettre à jour la base de données après la Création et purge de celci juste avant si la condition est vérifé
                cursor.execute(sql, (nbAbeille, mass_miel, message_alert, temp_int, temp_ext, temp_min, temp_max, humi_int, humi_ext, humi_min, humi_max)) #Execution
                connection.commit() #Commit
                print('Mise a jour des valeurs fini.')
                time.sleep(5)
                compteur += 1
                
                nbAbeille -= 55
                temp_ext -= 2
                temp_int -= 1
                temp_max -= 1
                temp_min -= 1
                humi_ext -= 1
                humi_int -= 1
                humi_min -= 1
                humi_max -= 1
               
                print("Nombre de requete actuel = ", compteur ," le ", dateComplete)
                time.sleep(1)

        finally:
            print('Finish.')
            time.sleep(5)
    connection.close()       
