<?php
include "database.php";
// include 'styles.php';
$result = mysqli_query($link, "SELECT * FROM `students`");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- <link rel="stylesheet" href="users.css" media="Screen" type="text/css"> -->
    <link rel="stylesheet" href="users.css?t=<?php echo (microtime(true) . rand()); ?>" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="name_table">Список пользователей</div>
    <table class="comicGreen">
        <thead>
            <tr>
                <th>ID</th>
                <th>Фамилия</th>
                <th>Имя</th>
                <th>Отчество</th>
                <th>E-mail</th>
                <th>Страна</th>
                <th>Город</th>
                <th>Логин</th>
                <th>Пароль</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="table_body">
            <?php
            while ($student = mysqli_fetch_assoc($result)) { ?>
                <tr class="new_row">
                    <td>
                        <?php echo $student['ID']; ?>
                    </td>
                    <td>
                        <?php echo $student['family']; ?>
                    </td>
                    <td>
                        <?php echo $student['name']; ?>
                    </td>
                    <td>
                        <?php echo $student['patronymic']; ?>
                    </td>
                    <td>
                        <?php echo $student['e-mail']; ?>
                    </td>
                    <td>
                        <?php echo $student['country']; ?>
                    </td>
                    <td>
                        <?php echo $student['sity']; ?>
                    </td>
                    <td>
                        <?php echo $student['login']; ?>
                    </td>
                    <td>
                        <?php echo $student['password']; ?>
                    </td>
                    <td>
                        <div class="btn remove" id=<?php echo $student['ID']; ?>>Удалить</div>
                    </td>
                </tr>
            <?php
            } ?>
        </tbody>
    </table>
    <!-- <div id="hello"></div> -->
    <div class="btn add">
        <div>Добавить нового пользователя</div>
        <div class="arrow">&crarr;</div>
    </div><br>

    <!-- секция импорта -->
    <section class=load_section>
        <label for="load_btn" class="btn load">Выберите файл</label><br>
        <form action="import.php" method="post" class="load_form" enctype="multipart/form-data">
            <input type="file" name="myfile" id="load_btn">
            <input type=submit value="Загрузить" class="btn load">
        </form>
    </section>

    <!-- секция экспорта -->
    <form method="POST" action="export.php">
        <label for="export_btn" class="btn insert">Экспорт таблицы</label>
        <input type="submit" name="export" value="Export exel" id="export_btn">
    </form>



    <div class="popup">
        <div class="popup_body">
            <div class="popup_content">
                <a href="#" class="popup_close">&#10008;</a>
                <div class="popup_title">
                    Добавить нового пользователя
                </div>
                <form id="append" action="" method="" class="popup_text">
                    <label for="name">Ваше имя:
                        <input type="text" name="name" placeholder="Ваше имя" required></label><br>
                    <label for="family">Ваша фамилия:</label>
                    <input type="text" name="family" placeholder="Ваша фамилия" required><br>
                    <label for="parents">Ваше отчество:</label>
                    <input type="text" name="parents" placeholder="Ваше отчество"><br>
                    <label for="email">E-mail:</label>
                    <input type=email name="email" placeholder="E-mail"><br>
                    <label for="country">Страна:</label>
                    <input type=text name="country" placeholder="Страна"><br>
                    <label for="city">Город:</label>
                    <input type=text name="city" placeholder="Город"><br>
                    <label for="login">Логин:</label>
                    <input type=text name="login" placeholder="Логин"><br>
                    <label for="parol">Пароль:</label>
                    <input type=password name="password" placeholder="Пароль"><br>
                    <input type="submit" id="sendMail" value="Добавить"></button><br>
                </form>
            </div>
        </div>
    </div>

    <!-- //delete -->
    <div class="popup_del">
        <div class="popup_body_del">
            <div class="popup_content_del">
                <!-- <a href="#" class="popup_close">&#10008;</a> -->
                <div class="popup_title">
                    Удалить файл из базы данных?
                </div>
                <div class="dialog_window">
                    <div class="dialog yes">Да</div>
                    <div class="dialog no">Нет</div>
                </div>
            </div>
        </div>
    </div>

    <script src="tableScript.js?$$REVISION$$">
        // удалить как выложу на удаленный сервер
    </script>
</body>

</html>