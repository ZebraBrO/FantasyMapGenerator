<?php
// Настройки подключения к базе данных
define('DB_HOST', 'localhost'); // Хост базы данных
define('DB_USER', 'root'); // Пользователь базы данных
define('DB_PASSWORD', ''); // Пароль пользователя базы данных
define('DB_NAME', 'ttrpg'); // Имя базы данных

// Установка соединения с базой данных
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Проверка соединения
if (!$conn) {
    die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
}
