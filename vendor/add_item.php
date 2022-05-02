
<?php

session_start();
require_once 'connect.php';

$item_name = $_POST['item_name'];
$item_code = $_POST['item_code'];

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
$check_item_code = mysqli_query($connect, "SELECT * FROM `items` WHERE `item_name` = '$item_name' AND `code` = '$item_code'");

if (mysqli_num_rows($check_item_code) > 0) {
    $response = [
        "status" => false,
        "message" => "Такой код оборудования уже существует",
        "type" => 1,
        "fields" => ['item_code']
    ];

    echo json_encode($response);
    die();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "INSERT INTO `items` (`id`, `item_name`, `code`) VALUES (NULL, '$item_name', '$item_code')");
$response = [
    "status" => true,
    "message" => "Оборудование добавлено!",
];
echo json_encode($response);
