<?php

$host = 'localhost';
$user = 'root';
$pass = 'andreluis2003';
$db_name = 'blog_radar_cultural';

$conn = new MySQLi($host, $user, $pass, $db_name);

if ($conn -> connect_error){
	die('Database connection error: '. $conn -> connect_error);
}