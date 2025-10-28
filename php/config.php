<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'root';
$name = getenv('DB_NAME') ?: 'tutorial';

$connection = mysqli_connect($host, $user, $pass, $name);
if (!$connection) {
    die('Connection failed: ' . mysqli_connect_error());
}
