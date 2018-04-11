# **SETUP**

* **SETUP ZONE + KEYBORD + HEURE + LANG**

* **INTERFACE (UX + SSH + VNC + dydns)**

* **APTITUDE + APT-GET + APT {UPDATE + UPGRADE}**

* **APACHE2 + PHP + MYSQL + PHPMYADMIN**

* **ARDUINO + GIT + VIM + pyserial**

* **HOTSPOT + DNS et HTTPS + SCRIPT de lecture des données en Python**

* **SITE WEB (HTML/CSS && PHP)**

* *Seedbox(datacenter)*

## **Script**

```py
#!/usr/bin/env python
# -*- coding: latin-1 -*-

import serial
import sys
import time

ser = serial.Serial('/dev/ttyACM0', 9600)
while 1 :
  print(ser.readline())
```

## **main.cpp**

```JS
/********************************************************
Toutes les 3 secondes, l'Arduino envoie un message qui
sera éventuellement reçu par un Raspberry pi.
********************************************************/

int compteur = 0;

void setup(){
  Serial.begin(9600);
}
void loop(){
  Serial.print("Message numero ");
  Serial.println(compteur);
  Serial.println("Bonjour, la Framboise, ici l'Arduino!");
  compteur++;
  delay(3000);
}
```

## UNIX

user ='pi'

mdp ='raspberry' 'choubalabala5'

## db

user ='root'

mdp ='unmotdepasse'
