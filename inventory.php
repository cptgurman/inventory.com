<?php
session_start();

if (!$_SESSION['user']) {
    header('Location: ../login.php');
}


/* Запрос в БД */
$dbh = new PDO('mysql:dbname=inventory;host=localhost', 'root', '');
$sth = $dbh->prepare("SELECT * FROM `items`");
$sth->execute();
$list = $sth->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оборудование</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>


    <!-- Navbar -->
    <table>
        <thead>
            <tr>
                <th>Наименование оборудования</th>
                <th>Код оборудования</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $row) : ?>
                <tr id="<?php echo $row['id']; ?>">
                    <td class='table-item' name='item-name'><a href="#"><?php echo $row['item_name']; ?></a></td>
                    <td class='table-item-code' name='item-code'><?php echo $row['code']; ?></td>
                    <td> <button type="button" class="item-employess" name="item-employess-btn">Список сотрудников</button></td>
                    <td> <button type="button" name="item-change-btn">Изменить</button></td>
                    <td> <button type="button" name="item-delete-btn">Удалить</button></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="container">
        <form>
            <p class="msg none">Добавить оборудование</p>
            <label>Наименование</label>
            <input type="text" name="item_name" id="" placeholder="Введите название оборудования">
            <label>Код</label>
            <input type="text" name="item_code" id="" placeholder="Введите код оборудования">
            <button type="submit" class="item-add-btn">Добавить</button>
        </form>
    </div>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/add-item.js"></script>

</body>

</html>