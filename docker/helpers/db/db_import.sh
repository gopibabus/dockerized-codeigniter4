#!/bin/sh

#--------------------------------------------------------------------------
# 🚀 Importing Database...
#--------------------------------------------------------------------------
export MYSQL_ROOT_USER="root"
export MYSQL_ROOT_PASSWORD="root"

cd /var/db;

mysql --user=$MYSQL_ROOT_USER --password=$MYSQL_ROOT_PASSWORD -e "DROP DATABASE IF EXISTS raptor;";

mysql --user=$MYSQL_ROOT_USER --password=$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE IF NOT EXISTS raptor;";

pv --progress -t -e -r -a /var/db/raptor.sql | mysql --user=$MYSQL_ROOT_USER --password=$MYSQL_ROOT_PASSWORD raptor;