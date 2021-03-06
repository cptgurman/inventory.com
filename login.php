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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<body>
    <form class="col-2 offset-lg-5 text-center align-middle">
        <div class="row justify-content-center">
            <img class="mb-1" src="https://hh.ru/employer-logo/3199889.jpeg" alt="" width="50">
        </div>

        <div class="form-label-group m-3">
            <input type="text" id="inputEmail" class="form-control" placeholder="Логин" name="login" required="" autofocus="">
            <label for="inputEmail">Логин </label>
        </div>

        <div class="form-label-group m-3">
            <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" name="password" required="">
            <label for="inputPassword">Пароль</label>
        </div>

        <button class="btn btn-lg btn-primary btn-block m-3 login-btn" type="submit">Войти</button>
        <p class="mt-5 mb-3 text-muted text-center">Нет аккаунта? <a href="register.php">Регистрация</a></p>
        <p class="msg none">Lorem ipsum dolor sit amet.</p>
    </form>



</body>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</html>