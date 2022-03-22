<?php include "database.php";

// print_r($_POST);
// var_dump($_POST);
// echo json_encode($_POST);

if ($_POST['act'] == 'delete') {
    $ID = $_POST['id'];
    // echo $ID;
    mysqli_query($link, "DELETE FROM `students`
     WHERE `students`.`ID` = '$ID'");
}
