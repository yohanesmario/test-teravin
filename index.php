<?php include "connection.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>List User</title>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <a href="add-user.php" class="btn btn-primary pull-right">ADD</a>
                <h1>List User</h1>
                <div class="clearfix"></div>
            </div>
            <div class="content">
                <?php
                    if (isset($_GET['search'])) {
                        $result = mysqli_query($connection, "
                            SELECT * FROM `users` WHERE `nama` LIKE '%".mysqli_real_escape_string($connection, $_GET['search'])."%';
                        ");
                    } else {
                        $result = mysqli_query($connection, "
                            SELECT * FROM `users`;
                        ");
                    }

                    $jsonData = array();
                    while($row=mysqli_fetch_assoc($result)) {
                        array_push($jsonData, $row);
                    }

                    if (isset($_GET['search']) || sizeof($jsonData)>0) {
                        ?>
                        <script type="text/javascript">
                            var users = <?php echo json_encode($jsonData); ?>
                        </script>
                        <form action="." method="GET" class="text-right form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" <?php
                                if (isset($_GET['search'])) {
                                    echo "value=\"".htmlspecialchars($_GET['search'])."\"";
                                }
                                ?> placeholder="Search by name">
                            </div>
                            <button type="submit" class="btn btn-default">SEARCH</button>
                        </form>
                        <br>
                        <?php
                        if (sizeof($jsonData)>0) {
                            ?>
                            <table id="user-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            Nama
                                            <div class="pull-right" data-field="nama">
                                                <div class="glyphicon glyphicon-triangle-top"></div>
                                                <div class="glyphicon glyphicon-triangle-bottom"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </th>
                                        <th>
                                            No. HP
                                            <div class="pull-right" data-field="hp">
                                                <div class="glyphicon glyphicon-triangle-top"></div>
                                                <div class="glyphicon glyphicon-triangle-bottom"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </th>
                                        <th>
                                            Email
                                            <div class="pull-right" data-field="email">
                                                <div class="glyphicon glyphicon-triangle-top"></div>
                                                <div class="glyphicon glyphicon-triangle-bottom"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </th>
                                        <th>
                                            Alamat
                                            <div class="pull-right" data-field="alamat">
                                                <div class="glyphicon glyphicon-triangle-top"></div>
                                                <div class="glyphicon glyphicon-triangle-bottom"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <?php
                        } else {
                            ?>
                            <div class="alert alert-danger">
                                No record found.
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-warning">
                            There's currently no existing data. Please create by clicking on the ADD button above.
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>

        <script src="js/jquery.js" charset="utf-8"></script>
        <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
        <script src="js/main.js" charset="utf-8"></script>
    </body>
</html>