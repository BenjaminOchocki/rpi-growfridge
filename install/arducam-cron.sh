#!/bin/bash
# Installs the cronjob which takes a picture and
# overrides the older one in the same location

# It might be the case, that there is no crontab for the user.
if crontab -l
then
  # Check if cronjob has already been added
  if ! crontab -l | grep 'camera.sh'
  then
    # Cronjob not found, backing up old cronjobs
    crontab -l > crontabs

    # Adding new cronjobs at the and of the backed up file
    # Adding the PATH variable before adding the cronjob enables access to it inside the cronjob
    echo 'PATH="/usr/local/bin:/usr/bin:/bin"' >> crontabs
    echo '*/15 * * * * sh /home/'$USER'/rpi-growfridge/env/python3/camera.sh' >> crontabs

    # Replace existing cronjobs with updated file
    crontab crontabs

    # Remove updated backup file
    rm crontabs
    echo -e "\n\n\tA REBOOT IS NEEDED\n\n"
    echo -e "\n\n\tIf you haven't modified your .env file yet, do it before the next step!\n\n"
    echo -e "\n\n\tRUN make setup-config NEXT\n\n"

  else
    # Cronjob has been found, nothing will be done
    echo -e "\n\n\tCronjob already installed\n\n"
  fi
else
  # There is no crontab. Initialize with default template
  echo "# Edit this file to introduce tasks to be run by cron.
#
# Each task to run has to be defined through a single line
# indicating with different fields when the task will be run
# and what command to run for the task
#
# To define the time you can provide concrete values for
# minute (m), hour (h), day of month (dom), month (mon),
# and day of week (dow) or use '*' in these fields (for 'any').
#
# Notice that tasks will be started based on the cron's system
# daemon's notion of time and timezones.
#
# Output of the crontab jobs (including errors) is sent through
# email to the user the crontab file belongs to (unless redirected).
#
# For example, you can run a backup of all your user accounts
# at 5 a.m every week with:
# 0 5 * * 1 tar -zcf /var/backups/home.tgz /home/
#
# For more information see the manual pages of crontab(5) and cron(8)
#
# m h  dom mon dow   command" > crontabs

  # Adding new cronjobs at the and of the backed up file
  # Adding the PATH variable before adding the cronjob enables access to it inside the cronjob
  echo 'PATH="/usr/local/bin:/usr/bin:/bin"' >> crontabs
  echo '*/15 * * * * sh /home/'$USER'/rpi-growfridge/env/python3/camera.sh' >> crontabs

  # Replace existing cronjobs with updated file
  crontab crontabs

  # Remove updated backup file
  rm crontabs
  echo -e "\n\n\tIf you haven't modified your .env file yet, do it before the next step!\n\n"
  echo -e "\n\n\tRUN 'make setup-config' NEXT\n\n"
fi
