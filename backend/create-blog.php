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
        
        $title = $_POST['title'];
        $content = $conn->real_escape_string($_POST['content']);
        $image = 'cover-blog/' . $nameFile;

        $sql = "INSERT INTO blogs (user_id, title, content, image) VALUE (4, '$title', '$content', '$image')";
        $result = $conn->query($sql);

        if ($result == TRUE) {
            header('location: ../admin/index.php');
        } else {
            echo "Gagal menyimpan blog:".
            $conn->error;
        }

    } else {
        echo "Gagal menyimpan gambar:".
        $conn->error;
    }
}

?>