<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'greateats';
// define('db_host', 'localhost');
// define('db_user', 'root');
// define('db_password', '');
// define('db_name', 'greateats');

//$pdo = new PDO("mysql:host=db_host;dbname=db_name", db_user, db_password);
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
