#!/usr/bin/env python
# -*- coding: latin-1 -*-

import serial
import sys
import time

# ser = serial.Serial( port='/dev/ttyACM0', baudrate = 9600)

fichier = open('test.txt',"r") # tu met un fichier txt au même endoirt que le script  avec le nom aa.txt
for ligne in fichier:
    if "PCI Location ID" in ligne:
        line = ligne.split()
        print("PCI Location ID :",line[-1])
        var = line[-1]