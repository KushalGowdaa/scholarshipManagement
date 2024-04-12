<?php

$host = 'localhost';
$dbname = 'scholarship_management';
$username = 'root';
$password = '';

$mysqli = new mysqli(hostname : $host, username : $username, password : $password, database : $dbname, port : '4306');

if ($mysqli->connect_errno) {
    die("Connection error : ". $mysqli->connect_error);
}

return $mysqli;