<?php
session_start(["use_strict_mode" => true]);
require('dbconnection.php');
unset($_SESSION['error_message']);

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $result->execute([$username]);
    $row = $result->fetch();

    if ($row) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['authenticated'] = $row['login'];
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['error_message'] = 'Вы ввели неправильный пароль!';
        }
    } else {
        $_SESSION['error_message'] = 'Вы ввели неправильный логин!';
    }

    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>
