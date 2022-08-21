# Bau einer automatisierten Klimakammer zur Anzucht von Pflanzen mit dem Raspberry Pi

Dieses Projekt ist eine Bachelorarbeit. In dieser Bachelorarbeit wird der Bau einer automatisierten Klimakammer
von der Theorie bis zur Benutzerschnittstelle durchgegangen. Diese Bachelorarbeit ist im Verzeichnis `thesis` zu finden.
Damit der `Growfridge` funktioniert, wird vorausgesetzt, dass die Kammer wie in der Bachelorarbeit zusammengebaut wird.
Jeglicher Code in diesem Repository wird erst nach Abschluss des Baus der Kammer auf das Raspberry Pi geklont. Jeder
Schritt ist in der Bachelorarbeit beschrieben.

## System Informationen

Eine Auflistung der Docker Images, welche in diesem Projekt genutzt werden:

| Image                                             | Tag/Version  |
|:--------------------------------------------------|:-------------|
| php (https://hub.docker.com/_/php)                | 8.1.9-fpm    |
| nginx (https://hub.docker.com/_/nginx)            | 1.23.1       |
| mariadb (https://hub.docker.com/_/mariadb)        | 10.8.3       |
| phpmyadmin (https://hub.docker.com/_/phpmyadmin)  | 5.2.0        |
| influxdb (https://hub.docker.com/_/influxdb)      | 2.3.0-alpine |
| python (https://hub.docker.com/_/python)          | 3.9.13       |


## Growfridge Installation und Bedienung
Ab diesem Schritt wird vorausgesetzt, dass der Growfridge bereits fertig gebaut und angeschlossen wurde. 
Ebenfalls muss git installiert sein. Sollte dies nicht der Fall sein, bitte mit `sudo apt install -y git` nachholen.

Danach wird das Repository in das Homeverzeichnis geklont.

Fuer die einfache Bedienung gibt es ein `Makefile`. Mit Hilfe von `make help` wird folgendes Menu ausgegeben:

| Task                        | Information                                                                       |
|:----------------------------|:----------------------------------------------------------------------------------|
| setup-login                 | Initialize credentials. Modify the .env file for your needs before you proceed!   |
| setup-software              | Needs root! Execute this to install system required software. Reboots afterwards! |
| setup-drivers               | Needs root! Install required hardware drivers. Reboots afterwards!                |
| setup-cron                  | Install required camera cronjob.                                                  |
| setup-config                | Execute this after you updated your .env file                                     |
| setup-container             | Setup Growfridge. This will shutdown by itself                                    |
|                             |                                                                                   |
| growfridge-start            | Start the Growfridge                                                              |
| growfridge-stop             | Stop the Growfridge                                                               |
| growfridge-restart          | Restart the Growfridge                                                            |
| growfridge-registration-off | Needs root! Removes the user registration option                                  |
| growfridge-registration-on  | Needs root! Activates the user registration option                                |
| generate-passwords          | If you have to generate new secure passwords run this                             |

Genau in dieser Reihenfolge sollten die Befehle ausdgefuhert werden, um den Growfridge inital einzurichten.
