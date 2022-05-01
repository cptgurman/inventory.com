
<?php

session_start();
require_once 'connect.php';

$item_id = $_POST['item_id'];
$employee_id = $_POST['employee_id'];


//Проверка выданного оборудования
$sql = "SELECT i.code, e.full_name, i.item_name, u.date_of_issue FROM items I Left Join item_usage U ON I.id = u.item_id Left join employees e ON e.id=u.employee_id Where U.item_id = $item_id AND U.employee_id = $employee_id AND u.date_of_receipt IS NULL";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$check_item_code = mysqli_query($connect, $sql);

if (mysqli_num_rows($check_item_code) > 0) {
    $response = [
        "status" => false,
        "message" => "Оборудование уже выдано!",
        "type" => 1,
        "fields" => ['item_code']
    ];

    echo json_encode($response);
    die();
}
//Выдача оборудования
$date = date('Y-m-d');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
mysqli_query($connect, "INSERT INTO `item_usage` (`id`, `item_id`, `employee_id`, `date_of_issue`, `date_of_receipt`) VALUES (NULL, '$item_id', '$employee_id', '$date', NULL)");
$response = [
    "status" => true,
    "message" => "Оборудование выдано!",
];
echo json_encode($response);
