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
    <!-- форма реги -->
    <form>
        <label>ФИО</label>
        <input type="text" name="full_name" id="" placeholder="Введите ФИО">
        <label>Логин</label>
        <input type="text" name="login" id="" placeholder="Введите логин">
        <label>E-mail</label>
        <input type="text" name="email" id="" placeholder="Введите почту">
        <label>Изображение профиля</label>
        <input type="file" name="avatar">
        <label>Пароль</label>
        <input type="password" name="password" id="" placeholder="Введите пароль">
        <label>Подтвердите пароль</label>
        <input type="password" name="password_confirm" id="" placeholder="Подтвердите пароль">
        <button type="submit" class="register-btn">Регистрация</button>
        <p>
            У вас уже есть аккаунт? |<a href="login.php">Войти</a>
        </p>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>

        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/main.js"></script>


    </form>
</body>

</html>