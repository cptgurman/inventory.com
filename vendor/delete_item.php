<?php
session_start();
require_once 'connect.php';


$item_id = $_POST['item_id'];

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "DELETE FROM items WHERE id = '$item_id'");
$response = [
    "status" => true,
    "message" => "Оборудование удалено!",
];
echo json_encode($response);
