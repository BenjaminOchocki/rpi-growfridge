#!/bin/bash
# Generates the correct amount of passwords needed for this setup

echo -e "\nHere are some passwords:"

for i in {1..5}
do
  # Using translate (tr) to filter all alphanumeric characters (alnum)
  # from a random number generator (/dev/urandom) piping the output (|)
  # into head to cut it after its first 64 characters (head -c 64)
  #
  # The reason this is done with alphanumeric characters is because
  # adding special characters might break the script or config files with
  # characters like " or ' etc.
  #
  # To still be secure i just increased the length to 64 characters
  tr -cd </dev/urandom "[:alnum:]" | head -c 64
  echo ""
done
echo ""

echo -e "Here is your influxdb token:"
tr -cd </dev/urandom "[:alnum:]" | head -c 90
echo -e "\n"
