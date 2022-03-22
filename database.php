<?php
    // echo "Данные приняты";
    $server = "127.0.0.1";
    $login = "root";
    $pass = "";
    $name_db = "studentdb";

    $link = mysqli_connect($server, $login, $pass, $name_db);
    if ($link ==False) {
        echo "Соедининие не удалось";
    }
    // else echo "Получилось";
?>