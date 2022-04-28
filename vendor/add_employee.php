
<?php

session_start();
require_once 'connect.php';

$full_name = $_POST['full_name'];
$inn = $_POST['inn'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$position = $_POST['position'];
$section = $_POST['section'];

$error_fields = [];


if ($item_name === '') {
    $error_fields[] = 'item_name';
}

if ($item_code === '') {
    $error_fields[] = 'item_code';
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

//Проверка существующего кода оборудования
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$check_employee_inn = mysqli_query($connect, "SELECT * FROM `employees` WHERE `inn` = '$inn'");

if (mysqli_num_rows($check_employee_inn) > 0) {
    $response = [
        "status" => false,
        "message" => "Такой сотрудник уже существует",
        "type" => 1,
        "fields" => ['item_code']
    ];

    echo json_encode($response);
    die();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "INSERT INTO `employees` (`id`, `full_name`, `inn`, `phone`, `email`, `position`, `section`) VALUES (NULL, '$full_name', '$inn', '$phone', '$email', '$position', '$section')");
$response = [
    "status" => true,
    "message" => "Сотрудник успешно добавлен!",
];
echo json_encode($response);
