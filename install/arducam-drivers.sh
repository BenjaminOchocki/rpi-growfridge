#!/bin/bash
echo -e "\n\n\tMUST BE RUN AS ROOT!\n\n"

# Download the current camera driver installer
# This is right from their documentation
# https://www.arducam.com/docs/cameras-for-raspberry-pi/64mp-camera-for-raspberry-pi/64mp-camera-troubleshooting/
wget -O install_pivariety_pkgs.sh https://github.com/ArduCAM/Arducam-Pivariety-V4L2-Driver/releases/download/install_script/install_pivariety_pkgs.sh
chmod +x install_pivariety_pkgs.sh

# Run the install script for the camera drivers and automatically decline reboot now question at the end of it
yes n | ./install_pivariety_pkgs.sh -p 64mp_pi_hawk_eye_kernel_driver
./install_pivariety_pkgs.sh -p libcamera_dev
./install_pivariety_pkgs.sh -p libcamera_apps

# Do some cleanup afterwards
rm -rf \
  64mp_pi_hawk_eye_kernel_driver_links.txt \
  arducam_64mp_kernel_driver_* \
  install_pivariety_pkgs.sh \
  libcamera-apps-* \
  libcamera_apps_links.txt \
  libcamera-dev-* \
  libcamera_dev_links.txt \
  packages.txt \
  Release

echo -e "\n\n\tA REBOOT IS NEEDED\n\n"
echo -e "\n\n\tRUN 'sudo make setup-cron' NEXT\n\n"

reboot
