<?php

session_start();
require_once 'connect.php';

$employee_id =  (int) $_GET['name'];
$item_id =  (int)$_GET['item'];
$status = (int) $_GET['status'];


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$sql = "SELECT u.id AS usage_id, i.id AS item_id, i.code AS item_code, COALESCE(e.full_name,'') AS full_name, i.item_name, COALESCE(u.date_of_issue,'') AS date_of_issue, COALESCE(u.date_of_receipt,'') AS date_of_receipt, CASE WHEN u.date_of_issue IS NULL THEN 'На складе' ELSE 'Выдан' END AS status FROM items I Left Join item_usage U ON I.id = u.item_id AND u.date_of_receipt IS NULL Left join employees e ON e.id=u.employee_id WHERE (u.employee_id = ? OR ? = -1) AND (u.item_id = ? OR ? = -1) AND (u.date_of_issue IS NULL OR ? = 0) ORDER BY item_name";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, 'iiiii', $employee_id, $employee_id, $item_id, $item_id, $status);
mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);

// чтение данных
$data = [];
while ($row = mysqli_fetch_array($res)) {
    array_push($data, $row);
}
echo json_encode($data);
