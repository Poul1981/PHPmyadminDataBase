<?php

include "database.php";

// $id = $_POST['ID'];
$family = $_POST['family'];
$name = $_POST['name'];
$patronymic = $_POST['parents'];
$email = $_POST['email'];
$country = $_POST['country'];
$sity = $_POST['city'];
$login = $_POST['login'];
$password = $_POST['password'];

//добавить строку  в БД
$response = mysqli_query($link, "INSERT INTO `students`(`ID`, `family`, `name`, 
    `patronymic`, `e-mail`, `country`, `sity`, `login`, `password`)
     VALUES ('','$family','$name','$patronymic','$email','$country','$sity','$login','$password')");


//вернуть последнюю  строку из БД
$sql = "SELECT * FROM `students` WHERE ID = (SELECT max(ID) FROM `students`);";
$last_rows = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($last_rows);
// print_r($row);
// var_dump($row);
echo json_encode($row);
