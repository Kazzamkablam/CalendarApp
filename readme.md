## noteMeUp

This repository contains the project files of this website. 

## About program

Program will be online database where you can register using username and password, your name being optional field. After you register you can create your own notes for specific dates which program will show in proper order. 
After you log in program will remember session details and you only need to log in again if you change device.
When you log in program will direct you to main screen where you can do all the necessary functions such as edit data, delete data, update data by using toggle menus behind buttons to access functionality.
Program will use data validation and will be combination PHP, CSS and Javascript.

## Install instructions

Installing program is easy after you acquire compatible database for it, simply copy all the files to wwwroot folder of your chosen database providers ftp folder.
I made program smart enough to search for database details automatically. Should it fail for some reason comment the following line from connect.php and register.php:
include 'get-connection.php'; 

enter your details manually to fields below:
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "localdb";

## Design document & SQL tables

You can find design document and SQL tables for this project under docs folder.
