<?php

session_start();
require_once 'connect.php';


$item_id =  (int)$_GET['item_id'];



mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql = "SELECT u.id, u.employee_id, COALESCE(e.full_name,'') AS full_name, COALESCE(u.date_of_issue,'') AS date_of_issue, COALESCE(u.date_of_receipt,'') AS date_of_receipt FROM item_usage U Left join employees e ON e.id=u.employee_id WHERE u.item_id = ? ORDER BY date_of_issue DESC";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'i', $item_id);
mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

// чтение данных
$data = [];
while ($row = mysqli_fetch_array($res)) {
    array_push($data, $row);
}
echo json_encode($data);
