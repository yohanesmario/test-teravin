<?php

    include "connection.php";

    if (isset($_POST['nama'])) {
        print_r($_POST);

        $nama = htmlspecialchars($_POST['nama']);
        $hp = htmlspecialchars($_POST['hp']);
        $email = htmlspecialchars($_POST['email']);
        $alamat = "";
        for ($i=0; $i < sizeof($_POST['alamat']); $i++) {
            $alamat .= htmlspecialchars($_POST['alamat'][$i]);
            if ($i+1 < sizeof($_POST['alamat'])) {
                $alamat .= "<br>";
            }
        }

        mysqli_query($connection, "
            INSERT INTO `users` VALUES (
                NULL,
                '".mysqli_real_escape_string($connection, $nama)."',
                '".mysqli_real_escape_string($connection, $hp)."',
                '".mysqli_real_escape_string($connection, $email)."',
                '".mysqli_real_escape_string($connection, $alamat)."'
            );
        ");

        header("Location:index.php");
        die();
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Create User</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Create User</h1>
            </div>
            <form id="user-form" action="add-user.php" method="post" novalidate>
                <div class="content">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="form-group">
                        <label>No. HP:</label>
                        <input type="text" class="form-control" id="hp" name="hp">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Alamat:</label>
                        <div class="clonable">
                            <div class="input-group">
                                <input type="text" class="form-control alamat" name="alamat[]">
                                <div class="input-group-addon">
                                    <button type="button" class="address-btn btn btn-success" data-function="add">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="controls text-right">
                    <button type="submit" class="btn btn-success">CREATE</button>
                    <a href="index.php" class="btn btn-warning">BACK</a>
                </div>
            </form>
        </div>

        <script src="js/jquery.js" charset="utf-8"></script>
        <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
        <script src="js/main.js" charset="utf-8"></script>
    </body>
</html>