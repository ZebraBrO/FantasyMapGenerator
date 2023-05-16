<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header id="header">
        <div class="headerTitle">
            <h1>Генератор карт</h1>
        </div>

        <div class="headerMenu">
            <a href="index.php">Home</a>
            <a href="index.php?page=map">Map</a>
            <a href="index.php?page=characters">Characters</a>
            <a href="index.php?page=campaigns">Campaigns</a>
            <a href="index.php?page=account">Account</a>
        </div>
    </header>

    <div class="container">
        <?php
        // Проверяем GET-параметр "page" и подключаем соответствующий файл
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            if ($page === 'map') {
                require('map.php');
            } elseif ($page === 'characters') {
                require('characters.php');
            } elseif ($page === 'campaigns') {
                require('campaigns.php');
            } elseif ($page === 'account') {
                require('account.php');
            } else {
                // Если значение GET-параметра "page" не соответствует ни одному из ожидаемых,
                // можно вывести сообщение об ошибке или перенаправить на другую страницу.
                echo 'Страница не найдена';
            }
        } else {
            // Если GET-параметр "page" не задан, выводим содержимое главной страницы
            echo 'Добро пожаловать на главную страницу';
        }
        ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
