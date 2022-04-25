<?php

session_start();
require_once 'connect.php';


$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE 'login'='$login'");

if (mysqli_num_rows($check_login) > 0) {
    $response = [
        "status" => false,
        "message" => "Такой логин уже существует",
        "type" => 1,
        "fields" => ['login']
    ];

    echo json_encode($response);
    die();
}
//пустые поля под валидацию
$error_fields = [];

//валидация
if ($login === '') {
    $error_fields[] = 'login';
}

if ($password === '') {
    $error_fields[] = 'password';
}
if ($password_confirm === '') {
    $error_fields[] = 'password_confirm';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error_fields[] = 'email';
}
if ($full_name === '') {
    $error_fields[] = 'full_name';
}
if (!$_FILES['avatar']) {
    $error_fields[] = 'avatar';
}

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "message" => "Не все поля заполнены",
        "type" => 1,
        "fields" => $error_fields
    ];

    echo json_encode($response);
    die();
}





if ($password === $password_confirm) {

    $path = 'uploads/' . time() . $_FILES['avatar']['name'];
    if (!move_uploaded_file($_FILES['avatar']['tmp_name'], '../' . $path)) {
        $response = [
            "status" => false,
            "message" => "Ошибка при загрузке фото",
            "type" => 2
        ];
        echo json_encode($response);
    }
    //хэшируем
    $password = md5($password);

    mysqli_query($connect, "INSERT INTO `users` (`id`, `full_name`, `login`, `email`, `password`, `avatar`) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

    $response = [
        "status" => true,
        "message" => "Регистрация прошла успешно!",
    ];
    echo json_encode($response);
} else {
    $response = [
        "status" => false,
        "message" => "Пароли не совпадают",
    ];
    echo json_encode($response);
}
