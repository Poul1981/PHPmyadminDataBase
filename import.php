<?php
// var_dump($_FILES);
// print_r($_FILES);
// echo $_FILES['myfile']['name'];
// импортирует таблицу формата XLS в базу данных
include "database.php";

if (!empty($_FILES["myfile"]["name"])) {
    // $connect = mysqli_connect("localhost", "root", "", "testing");
    $output = '';
    $allowed_ext = array("xls");
    $expl = explode(".", $_FILES["myfile"]["name"]);
    $extension = end($expl);
    if (in_array($extension, $allowed_ext)) {
        $file_data = fopen($_FILES["myfile"]["tmp_name"], 'r');
        // import file
        $head = fgetcsv($file_data); //first string blow up
        // var_dump($head);
        while ($row = fgetcsv($file_data)) {
            $id = mysqli_real_escape_string($link, $row[0]);
            $family = mysqli_real_escape_string($link, $row[1]);
            $name = mysqli_real_escape_string($link, $row[2]);
            $patron = mysqli_real_escape_string($link, $row[3]);
            $email = mysqli_real_escape_string($link, $row[4]);
            $country = mysqli_real_escape_string($link, $row[5]);
            $city = mysqli_real_escape_string($link, $row[6]);
            $login = mysqli_real_escape_string($link, $row[7]);
            $password = mysqli_real_escape_string($link, $row[8]);

            $query = "INSERT INTO `students`(`ID`, `family`, `name`, 
            `patronymic`, `e-mail`, `country`, `sity`, `login`, `password`)
             VALUES ('','$family','$name','$patron','$email','$country','$city','$login','$password')";
            mysqli_query($link, $query);
        }
        // отразить в таблице на экране
        $select = "SELECT * FROM `students`";
        $result = mysqli_query($link, $select);

        while ($row = mysqli_fetch_array($result)) {
            $output .=
                '<tr class="new_row">  
                    <td>' . $row["ID"] . '</td>  
                    <td>' . $row["family"] . '</td>  
                    <td>' . $row["name"] . '</td> 
                    <td>' . $row["patronymic"] . '</td>  
                    <td>' . $row["e-mail"] . '</td>  
                    <td>' . $row["country"] . '</td>  
                    <td>' . $row["sity"] . '</td>
                    <td>' . $row["login"] . '</td>
                    <td>' . $row["password"] . '</td>  
                    <td><div class="btn remove" id=' . $row["ID"] . '>Удалить</div></td>
                </tr>';
        }
        echo $output;
    } else {
        echo 'Error1';
    }
} else {
    echo "Error2";
}
