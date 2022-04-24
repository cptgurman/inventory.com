<?php
session_start();

if ($_SESSION['user']) {
    header('Location: ../profile.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация и регистрации</title>
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <!-- форма аут -->
    <form action="vendor/signin.php" method="post">
        <label>Логин</label>
        <input type="text" name="login" id="" placeholder="Введите логин">
        <label>Пароль</label>
        <input type="password" name="password" id="" placeholder="Введите пароль">
        <button type="submit">Войти</button>
        <p>У вас нет аккаунта? |<a href="register.php">Зарегистрироваться</a> </p>
        <?php
        if ($_SESSION['message']) {
            echo '<p class="msg">' . $_SESSION['message'] . '</p>';
        }
        unset($_SESSION['message']);
        ?>
    </form>
</body>

</html>