<?php if (isset($_SESSION['error_message'])): ?>
    <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']): ?>
    <div class="authFormBody">Вы вошли в аккаунт<a href="login.php?logout=true" class="menuButtons">Выйти</a></div>
<?php else: ?>
    <div class="authFormBody">
        <div class="authFormContainer">
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
                    <td colspan="2"><p>Sign in</p></td>
                </tr>
                <tr>
                    <td colspan="2"><button onclick="signUp()">Sing up</button></td>
                </tr>
            </table>
        </div>
    </div>
<?php endif; ?>
