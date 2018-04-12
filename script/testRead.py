#!/usr/bin/env python
# -*- coding: latin-1 -*-

import serial
import sys
import time

ser = serial.Serial( port='/dev/ttyACM0', baudrate = 9600)
while 1:
 x = ser.readline()
 print(x)
 if x == "H =":
     humi = ''
