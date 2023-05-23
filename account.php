<?php
require_once 'dbconnection.php'; // Подключите файл с настройками подключения к базе данных

// Проверяем, вошел ли пользователь в аккаунт
$authenticated = isset($_SESSION['authenticated']) && $_SESSION['authenticated'];

// Очищаем сообщение об ошибке из сессии
unset($_SESSION['error_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка формы регистрации
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        // Создание записи в базе данных
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        if ($conn->connect_error) {
            die("Ошибка подключения к базе данных: " . $conn->connect_error);
        }

        // Хеширование пароля
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (login, password) VALUES ('$login', '$hashedPassword')";

        if ($conn->query($sql) === true) {
            // Пользователь успешно зарегистрирован
            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $login;
            header("Location: index.php?page=account");
            exit();
        } else {
            // Ошибка при создании записи в базе данных
            $_SESSION['error_message'] = "Ошибка при регистрации пользователя.";
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
<?php if ($error_message): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

<?php if ($authenticated): ?>
    <div class="authFormBody">
        <div class="authFormContainer">
            Вы вошли в аккаунт, <?php echo $_SESSION['username']; ?>! <a href="login.php?logout=true" class="menuButtons">Выйти</a>
        </div>
    </div>
<?php else: ?>
    <div class="authFormBody">
        <div class="authFormContainer">
            <form action="login.php" method="post" id="signIn">
                <?php if ($error_message): ?>
                    <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <label for="username">Логин: </label>
                <input type="text" id="username" name="username">
                <br>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password">
                <br>
                <input type="submit" value="Войти">
                <input type="button" value="Регистрация" onclick="toggleForms()">
            </form>
            <form action="account.php" method="post" id="signUp" class="hidden">
                <table>
                    <tr>
                        <td class="lbl"><label for="login">Логин:</label></td>
                        <td><input class="fld" id="login" type="text" name="login" required></td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="password">Пароль:</label></td>
                        <td><input class="fld" id="password" type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" class="test" value="Зарегистрироваться"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="button" onclick="toggleForms()">Вход</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
<?php endif; ?>

<script>
    function toggleForms() {
        var signInForm = document.getElementById("signIn");
        var signUpForm = document.getElementById("signUp");

        signInForm.classList.toggle("hidden");
        signUpForm.classList.toggle("hidden");
    }
</script>
</body>
</html>
