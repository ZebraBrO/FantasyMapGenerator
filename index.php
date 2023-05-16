<?php
session_start();

$valid_username = 'admin';
$valid_password = 'password';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        $_SESSION['username'] = $username;
        $_SESSION['authenticated'] = true;
        header('Location: index.php');
        exit();
    } else {
        $_SESSION['error_message'] = 'Неверный логин или пароль';
    }
}

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
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
            <button class="menuButtons">Map</button>
            <button class="menuButtons">Story</button>
            <button class="menuButtons">Characters</button>
            <button class="menuButtons">Campaigns</button>
            <button class="menuButtons" onclick="auth()">Account</button>
        </div>
    </header>

    <section class="modalAuthForm" id="authForm">
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']): ?>
            <div class="authFormBody">Вы вошли в аккаунт<a href="login.php?logout=true" class="menuButtons">Выйти</a></div>
        <?php else: ?>
            <div class="authFormBody">
                <form action="login.php" method="post">
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
                    <?php endif; ?>
                    <label for="username">Логин: </label>
                    <input type="text" id="username" name="username">
                    <br>
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password">
                    <br>
                    <input type="submit" value="Войти">
                </form>
                <table class="authFormSignUp" id="signUp">
                    <tr>
                        <td class="lbl"><label for="Login/email">Login/email:</label></td>
                        <td><input class="fld" id="Login/email" type="text" required></td>
                    </tr>
                    <tr>
                        <td class="lbl"><label for="password">Password:</label></td>
                        <td><input class="fld" id="password" type="text" required></td>
                    </tr>
                    <tr>
                        <td><p>Sign in</p></td>
                        <td><button>Sing in</button></td>
                    </tr>
                    <tr>
                        <td><p>Sign up</p></td>
                        <td><button onclick="signUp()">Sing up</button></td>
                    </tr>
                </table>
            </div>
        <?php endif; ?>
    </section>
        <script src="script.js"></script>
</body>
</html>
