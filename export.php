<?php

include "database.php";

if (isset($_POST["export"])) {
    // $connect = mysqli_connect("localhost", "root", "", "testing");
    header('Content-Type: text/xls; charset=utf-8');
    header('Content-Disposition: attachment; filename=data_student.xls');
    $output = fopen("php://output", "w"); //
    fputcsv($output, array(
        'ID', 'Family', 'Name', 'Patronim',
        'E-mail', 'Country', 'City', 'Login', 'Password'
    ));
    $query = "SELECT * from `students`";
    $result = mysqli_query($link, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
}
