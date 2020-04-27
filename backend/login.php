<?php

require '../connect.php';

if ($_POST) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['status'] = 'login';
        header('location: ../index.php');
    } else {
        header('location: ../login.php');
    }
}

?>