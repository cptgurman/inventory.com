<?php
session_start();
require_once 'connect.php';

$item_name = $_POST['item_name'];
$item_code = $_POST['item_code'];
$item_id = $_POST['item_id'];

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


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "UPDATE items SET item_name='$item_name', code='$item_code' WHERE id='$item_id'");
$response = [
    "status" => true,
    "message" => "Оборудование добавлено!",
];
echo json_encode($response);
