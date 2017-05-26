<?php

    $connection = mysqli_connect(
        "localhost", //Host
        "root", //Database Username
        "whitemouse", //Database Password
        "testteravin" //Database Name
    );

    $result = mysqli_query($connection, "
        SELECT *
        FROM information_schema.tables
        WHERE table_schema = 'testteravin'
            AND table_name = 'users'
        LIMIT 1;
    ");

    if (mysqli_num_rows($result)<=0) {
        $result = mysqli_query($connection, "
            CREATE TABLE `users` (
                `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                `nama` VARCHAR(50) NOT NULL,
                `hp` VARCHAR(20) NOT NULL,
                `email` VARCHAR(100) NOT NULL,
                `alamat` VARCHAR(2000) NOT NULL
            );
        ");

        echo "created";
    }
