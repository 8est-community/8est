<?php

require '../connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM blogs WHERE id = '$id'";
$result = $conn->query($sql);

if ($result == TRUE) {
    header('location: ../admin/index.php');
} else {
    echo "Gagal delete blog";
}
?>