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
        <div class="authFormBody">
            <form method="POST" enctype="multipart/form-data">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>"><br>
              
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br>
            
              
                <input type="submit" name="submit" value="Sign In">
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
    </section>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $file = $_FILES['file'];

    setcookie('username', $username, time() + 3600); // сохраняем имя пользователя в cookie
    }

    // проверяем, есть ли сохраненные значения в cookie
    $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
    $password = '';

    // если есть POST-параметры и нет сохраненных значений в cookie, используем POST-параметры
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$username) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    }
    ?>
    <script src="script.js"></script>
</body>
</html>