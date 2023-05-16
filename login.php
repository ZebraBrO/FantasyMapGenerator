<?php
    session_start(["use_strict_mode" => true]);
    unset($_SESSION['error_message']);
    if (isset($_POST['username'])){
        if ($_POST['username'] == 'admin'){
            if ($_POST['password'] == '123'){
                $_SESSION['authenticated'] = $_POST['username'];
                header("Location: index.php");
                die();
            }
            else {
                $_SESSION['error_message'] = 'Вы ввели неправильный пароль!';
                header("Location: index.php");
                die();
            }

        }
        else {
            $_SESSION['error_message'] = 'Вы ввели неправильный логин!';
            header("Location: index.php");
            die();
        }

    }
    if (isset($_GET['logout'])) {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
        exit();
    }