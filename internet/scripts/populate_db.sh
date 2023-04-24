#!/bin/sh


mysql -u root -e "CREATE DATABASE meuteste;"
mysql -u root -D meuteste -e "CREATE TABLE config (id integer, nome varchar(20));"


mysql -u root -D meuteste -e "INSERT INTO config VALUES (1, 'Rodolfo');"
mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'root' IDENTIFIED BY 'password';"
mysql -u root -ppassword -e "SELECT 1;"
