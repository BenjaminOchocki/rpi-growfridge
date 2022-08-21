#!/bin/bash
echo -e "\n\n\tMUST BE RUN AS ROOT!\n\n"

echo -e "\n\n\tEnable I2C Interface\n\n"

# Activating the I2C interface and updating the boot config
raspi-config nonint do_i2c 1
sed -i "s/dtparam=i2c_arm=off/dtparam=i2c_arm=on/g" /boot/config.txt

echo -e "\n\n\tEnable Camera in /boot/config.txt\n\n"

# Check, if memory already has been reserved for the camera
if ! grep -rnw '/boot/config.txt' -e 'dtoverlay=vc4-kms-v3d,cma-512'
then
  # This config update is specially for the raspberry pi 4.
  sed -i "s/arm_boost=1/arm_boost=1\ndtoverlay=vc4-kms-v3d,cma-512/g" /boot/config.txt

  # The position can be different depending on the raspberry pi model (eg. rpi 3)
  # This project runs on a rpi 4 but if you modify the setup and somehow use a rpi 3
  # with the arducam 64MP, then add this line on the end of you config (without the # and '')
  # 'dtoverlay=vc4-kms-v3d,cma-512'
fi

# PErform a full update, upgrade and install system required packages
apt update && apt install -y git curl wget libffi-dev libssl-dev python3 python3-dev python3-pip

# Install docker
curl -sSL https://get.docker.com | sh

# Add current user to the docker group so it has permissions on the docker socket
usermod -aG docker $(id -nu 1000)

# Install latest docker-compose
curl -L "https://github.com/docker/compose/releases/download/$(curl https://github.com/docker/compose/releases | grep -m1 '<a href="/docker/compose/releases/download/' | grep -o 'v[0-9]*.[0-9]*.[0-9]*')/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose

# Add execute permissions on docker-compose
chmod +x /usr/local/bin/docker-compose

# Enable the docker service
systemctl enable docker

echo -e "\n\n\tA REBOOT IS NEEDED\n\n"
echo -e "\n\n\tRUN 'sudo make setup-drivers' NEXT\n\n"

reboot
