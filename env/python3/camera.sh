#!/bin/bash

# Executes libcamera with autofocus.
# Because of the way the camera is mounted it creates upside down pictures.
# Luckily for us, libcamera supports flipping images
# Also we want to always override the older picture in the same location
libcamera-still --autofocus --hflip --vflip --output '/home/REPLACE_USER/rpi-growfridge/src/public/pic.jpg'
