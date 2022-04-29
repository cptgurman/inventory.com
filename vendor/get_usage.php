<?php

session_start();
require_once 'connect.php';
$sql = "SELECT i.code, e.full_name, i.item_name, u.date_of_issue FROM items I Left Join item_usage U ON I.id = u.item_id Left join employees e ON e.id=u.employee_id Where e.full_name IS NOT NULL";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$usage = mysqli_query($connect, $sql);
$data = [];
while ($row = mysqli_fetch_array($usage)) {
    array_push($data, $row);
}
echo json_encode($data);
