#!/bin/bash
# Preparing the copied example files with values from the .env file

# Array of all placeholders
declare -a placeholder=(GROWFRIDGE_DATABASE_USER GROWFRIDGE_DATABASE_PASSWORD PHPMYADMIN_DATABASE_NAME PHPMYADMIN_DATABASE_USER PHPMYADMIN_DATABASE_PASSWORD LARAVEL_DATABASE_NAME LARAVEL_DATABASE_USER LARAVEL_DATABASE_PASSWORD INFLUXDB_TOKEN INFLUXDB_ORGANISATION INFLUXDB_BUCKET PHPMYADMIN_DATABASE_USER PHPMYADMIN_DATABASE_PASSWORD GROWFRIDGE_DATABASE_NAME RELAY_1_NAME RELAY_2_NAME RELAY_3_NAME RELAY_4_NAME RELAY_5_NAME RELAY_6_NAME RELAY_7_NAME RELAY_8_NAME RELAY_1_CHANNEL RELAY_2_CHANNEL RELAY_3_CHANNEL RELAY_4_CHANNEL RELAY_5_CHANNEL RELAY_6_CHANNEL RELAY_7_CHANNEL RELAY_8_CHANNEL RELAY_WAIT I2C_PORT I2C_ADDRESS SENSOR_VALUES_PER_MINUTE SENSOR_VALUES_SAVED_BEFORE_WRITE_TO_DB)

# For each placeholder replace its value if found in file
for i in "${placeholder[@]}"
do
   :
   sed -i "s/$(echo $i)/$(grep "$i" ./.env | cut -d "=" -f2)/g" ./env/mariadb/initdb/*.sql
   sed -i "s/$(echo $i)/$(grep "$i" ./.env | cut -d "=" -f2)/g" ./env/python3/relayboard/*.py
   sed -i "s/$(echo $i)/$(grep "$i" ./.env | cut -d "=" -f2)/g" ./env/python3/sensor/*.py
done

sed -i "s/INFLUXDB_ORGANISATION_REPLACE/$(grep "INFLUXDB_ORGANISATION" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/INFLUXDB_TOKEN_REPLACE/$(grep "INFLUXDB_TOKEN" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/INFLUXDB_DBNAME_REPLACE/$(grep "INFLUXDB_ORGANISATION" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/INFLUXDB_USER_REPLACE/$(grep "INFLUXDB_USERNAME" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/INFLUXDB_PASSWORD_REPLACE/$(grep "INFLUXDB_PASSWORD" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/LARAVEL_DATABASE_PASSWORD_REPLACE/$(grep "LARAVEL_DATABASE_PASSWORD" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/INFLUXDB_BUCKET_REPLACE/$(grep "INFLUXDB_BUCKET" ./.env | cut -d "=" -f2)/g" ./src/.env
sed -i "s/TIMEZONE_REPLACE/$(grep "TIMEZONE" ./.env | cut -d "=" -f2)/g" ./src/.env

echo -e "\n\n\tRUN 'make setup-container' NEXT\n\n"