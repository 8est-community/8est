<?php

require '../connect.php';

if ($_POST) {
    // Ambil data file
    $nameFile = $_FILES['image']['name'];
    $nameSementara = $_FILES['image']['tmp_name'];

    // Tentukan letak lokasi penyimpanan file
    $path = '../cover-blog/';

    $simpanFile = move_uploaded_file($nameSementara, $path.$nameFile);

    if ($simpanFile == TRUE) {
        
        $id = $_GET['id'];
        $title = $_POST['title'];
        $content = $conn->real_escape_string($_POST['content']);
        $image = 'cover-blog/' . $nameFile;

        $sql = "UPDATE blogs SET title = '$title', content = '$content', image = '$image' WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            header('location: ../admin/index.php');
        } else {
            echo "Gagal menyimpan blog:".
        $conn->error;
        }

    } else {
        echo "Gagal menyimpan gambar";
    }
}

?>