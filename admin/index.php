<?php

require '../connect.php';

session_start();
if ($_SESSION['status'] != 'login') {
    header('location: ../login.php');
}

$email = $_SESSION['email'];

$sqlLogin = "SELECT * FROM users WHERE email = '$email'";
$userLogin = $conn->query($sqlLogin);
$user = $userLogin->fetch_assoc();

if ($user['role'] == 'user') {
    die('Kamu tidak dapat mengakses halaman admin');
}


$sqlBlog = "SELECT * FROM blogs";
$resultBlog = $conn->query($sqlBlog);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">MyBlog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../blog.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/index.php">Admin</a>
                    </li>
                    <?php
                    
                    if ($_SESSION && $_SESSION['status'] == 'login') { ?>
                    
                        <li class="nav-item ml-5">
                            <a class="btn btn-success" href="backend/logout.php">Logout</a>
                        </li>                    

                    <?php
                    } else { ?>
                        
                        <li class="nav-item ml-5">
                            <a class="btn btn-success" href="login.php">Login</a>
                        </li>
                        <li class="nav-item ml-2">
                            <a class="btn btn-primary" href="register.php">Register</a>
                        </li>

                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    
    <section id="admin-blog" class="mt-5">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <a href="create-blog.php" class="btn btn-primary">Add New Blog</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Content</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                while ($row = $resultBlog->fetch_assoc()) { ?>
                                  <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['title'] ?></td>
                                        <td><?php echo substr($row['content'], 0, 50) ?> ....</td>
                                        <td>
                                            <a href="edit-blog.php?id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete-blog.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>