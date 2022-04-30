
<?php

session_start();
require_once 'connect.php';

$item_usage_id = $_POST['item_usage_id'];



//Выдача оборудования
$date = date('Y-m-d');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "UPDATE item_usage SET date_of_receipt='$date' WHERE id='$item_usage_id'");
$response = [
    "status" => true,
    "message" => "Оборудование возвращено!",
];
echo json_encode($response);
