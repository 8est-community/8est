<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = '8est';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "Gagal konek ke database";
}

?>