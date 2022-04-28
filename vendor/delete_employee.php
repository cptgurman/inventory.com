<?php
session_start();
require_once 'connect.php';


$id = $_POST['employee_id'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "DELETE FROM employees WHERE id = '$id'");
$response = [
    "status" => true,
    "message" => "Сотрудник удален!",
];
echo json_encode($response);
