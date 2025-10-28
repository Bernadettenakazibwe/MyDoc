<?php
$host = getenv('DB_HOST') ?: 'db';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASSWORD') ?: 'root';
$db   = getenv('DOCTOR_DB') ?: 'doctors';

$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Connection failed (doctor DB): " . mysqli_connect_error());
}
?>
