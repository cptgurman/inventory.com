<?php
session_start();
require_once 'connect.php';

$full_name = $_POST['full_name'];
$inn = $_POST['inn'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$position = $_POST['position'];
$section = $_POST['section'];
$id = $_POST['id'];

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
mysqli_query($connect, "UPDATE employees SET full_name='$full_name', inn='$inn', phone='$phone',email='$email',position='$position',section='$section' WHERE id='$id'");
$response = [
    "status" => true,
    "message" => "Сотрудник изменен",
];
echo json_encode($response);
