<?php
session_start(["use_strict_mode" => true]);
require('dbconnection.php');
unset($_SESSION['error_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['authenticated'] = $row['login'];
                header('Location: index.php?page=account');
                exit();
            } else {
                $_SESSION['error_message'] = 'Вы ввели неправильный пароль!';
            }
        } else {
            $_SESSION['error_message'] = 'Вы ввели неправильный логин!';
        }

        header('Location: index.php?page=account');
        exit();
    }
}

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php?page=account');
    exit();
}
?>
