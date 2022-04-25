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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- форма аут -->
    <form>
        <label>Логин</label>
        <input type="text" name="login" id="" placeholder="Введите логин">
        <label>Пароль</label>
        <input type="password" name="password" id="" placeholder="Введите пароль">
        <button type="submit" class="login-btn">Войти</button>
        <p>У вас нет аккаунта? |<a href="register.php">Зарегистрироваться</a> </p>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>