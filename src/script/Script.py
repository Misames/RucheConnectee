#!/usr/bin/env python
# -*- coding: utf-8 -*-

# we import the features and libraries we need to process the information

import serial
import sys
import time
import pymysql.cursors

# Connection to the database

connection = pymysql.connect(host='localhost',
                             user='root',
                             password='',
                             db='projetRuche',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

# initialization of the variables

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

date = time.strftime("%d %H")  # fonction pour avoir le jour actuel et l'heure
# ser = serial.Serial(port='/dev/ttyACM0', baudrate = 9600) # function to Read the serial port
mon_fichier = open("test.txt", "r")  # file to read
try:
    with connection.cursor() as cursor:

        # creating the table
        print("Verification ... made in ", date)
        time.sleep(3)
        sql = "CREATE TABLE IF NOT EXISTS `Ruche` (`id` int(255) NOT NULL AUTO_INCREMENT, `nb_abeille` int(255) COLLATE utf8_bin NOT NULL,`mass_miel` float(22) COLLATE utf8_bin NOT NULL,`message_alert` int(255) COLLATE utf8_bin NOT NULL, `temp_int` float(22) COLLATE utf8_bin NOT NULL, `temp_ext` float(22) COLLATE utf8_bin NOT NULL,`temp_min` float(22) COLLATE utf8_bin NOT NULL,`temp_max` float(22) COLLATE utf8_bin NOT NULL,`humi_int` float(22) COLLATE utf8_bin NOT NULL, `humi_ext` float(22) COLLATE utf8_bin NOT NULL,`humi_min` float(22) COLLATE utf8_bin NOT NULL,`humi_max` float(22) COLLATE utf8_bin NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1"
        cursor.execute(sql)

    connection.commit()  # Commit

finally:
    print('Verification end.')

while 1:
    while compteur_serial == 0:
        for ligne in mon_fichier:  # we read line by line the serial port
            if "number of bees" in ligne:  # if we read "number of bees" in the serial port we cut it word by word then we take the line that interests us
                line = ligne.split()
                print("number of bees =", line[-1])
                nb_abeille = line[-1]
            if "honey mass" in ligne:
                line = ligne.split()
                print("honey mass =", line[-2])
                mass_miel = line[-2]
            if "alert" in ligne:
                line = ligne.split()
                print("alert =", line[-1])
                message_alert = line[-1]
            if "temperature inside" in ligne:
                line = ligne.split()
                print("temperature inside =", line[-2])
                temp_int = line[-2]
            if "temperature outside" in ligne:
                line = ligne.split()
                print("temperature outside =", line[-2])
                temp_ext = line[-2]
            if "temperature minimum" in ligne:
                line = ligne.split()
                print("temperature minimum =", line[-2])
                temp_min = line[-2]
            if "temperature maximum" in ligne:
                line = ligne.split()
                print("temperature maximum =", line[-2])
                temp_max = line[-2]
            if "humidity inside" in ligne:
                line = ligne.split()
                print("humidity inside =", line[-2])
                humi_int = line[-2]
            if "humidity outside" in ligne:
                line = ligne.split()
                print("humidity outside =", line[-2])
                humi_ext = line[-2]
            if "humidity minimum" in ligne:
                line = ligne.split()
                print("humidity minimum =", line[-2])
                humi_min = line[-2]
            if "humidity maximum" in ligne:
                line = ligne.split()
                print("humidity maximum =", line[-2])
                humi_max = line[-2]
            if "finish" in ligne:
                compteur_serial = 1
                print("End to the reading.")
                break
        try:
            with connection.cursor() as cursor:
                date = time.strftime("%d %H")
                dateComplete = time.strftime("%A %d %B %Y %H:%M:%S")

                if date == '30 02':   # reset the database on the 31st of the month at 2am and for one hour block the system
                    sql = "TRUNCATE TABLE `Ruche`"
                    cursor.execute(sql)  # Execution
                    print("Table purged at ", date)
                    print("Loading the new table ...")
                    time.sleep(3600)
                    compteur = 0
                    connection.commit()  # Commit

                # We execute an SQL query to add data to the database
                # requête SQL pour mettre à jour la base de données après la Création et purge de celci juste avant si la condition est vérifé
                sql = "INSERT INTO `Ruche` (`nb_abeille`, `mass_miel`, `message_alert`,  `temp_int`, `temp_ext`, `temp_min`, `temp_max` , `humi_int`, `humi_ext`, `humi_min`, `humi_max`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s ,%s, %s, %s)"
                cursor.execute(sql, (nb_abeille, mass_miel, message_alert, temp_int, temp_ext,
                                     temp_min, temp_max, humi_int, humi_ext, humi_min, humi_max))  # Execution
                connection.commit()  # Commit
                print('Update values, end.')
                time.sleep(5)
                compteur += 1
                print("Number of query actualy = ",
                      compteur, " at ", dateComplete)
                time.sleep(1)
        finally:
            print('Finish.')
            compteur_serial = 0
            time.sleep(5)
connection.close()
