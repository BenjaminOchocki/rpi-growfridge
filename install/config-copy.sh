#!/bin/bash
# Copy all example files in their own directory without the .example in the filename

cp ./.env.example ./.env
cp ./src/.env.example ./src/.env
cp ./env/mariadb/initdb/01_create_databases.sql.example ./env/mariadb/initdb/01_create_databases.sql
cp ./env/mariadb/initdb/02_create_tables.sql.example ./env/mariadb/initdb/02_create_tables.sql
cp ./env/python3/relayboard/relays_off.py.example ./env/python3/relayboard/relays_off.py
cp ./env/python3/relayboard/relays_switcher.py.example ./env/python3/relayboard/relays_switcher.py
cp ./env/python3/sensor/sensor_reader.py.example ./env/python3/sensor/sensor_reader.py

sed -i "s/REPLACE_USER/$(echo $USER)/g" ./env/python3/camera.sh

echo "Please update your .env file"
echo "Insert your login credentials and create secure passwords!"
