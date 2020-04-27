<?php

require '../connect.php';

if ($_POST) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        header('location: ../login.php');
    } else {
        echo "Gagal mendaftar";
    }
}

?>