<?php
session_start();

if (!$_SESSION['user']) {
    header('Location: ../login.php');
}


/* Запрос в БД */
// Оборудование
$dbh = new PDO('mysql:dbname=inventory;host=localhost', 'root', '');
$sth = $dbh->prepare("SELECT * FROM `items`");
$sth->execute();
$inventory = $sth->fetchAll(PDO::FETCH_ASSOC);

$employees = $dbh->prepare("SELECT * FROM `employees`");
$employees->execute();
$employee = $employees->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>

<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
        </svg>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="profile.php" class="nav-link px-2 link-dark">Главная</a></li>
        <li><a href="inventory.php" class="nav-link px-2 link-dark">Перечень оборудования</a></li>
        <li><a href="employees.php" class="nav-link px-2 link-dark">Перечень сотрудников</a></li>
        <li><a href="usage.php" class="nav-link px-2 link-secondary">Использование оборудования</a></li>
    </ul>

    <div class="col-md-3 text-end p-2">
        <a>Герман Креханов</a>
        <a class="btn btn-primary" href="index.html" role="button">Выйти</a>
    </div>
</header>


<body>
    <div class="container">
        <div class="container m-5">
            <div class="b-example-divider"></div>
            <button type="button" class="btn btn-success choose-usage" data-bs-toggle="modal" data-bs-target="#chooseUsage">Выдать
                оборудование</button>
        </div>
        <div class="container d-inline-flex">
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
            <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table thetable" id="table">
                    <thead>
                        <tr>
                            <th scope="col">Инвентарный номер</th>
                            <th scope="col">Наименование оборудования</th>
                            <th scope="col">Сотрудник</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата выдачи</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- сюда jquery вставит -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Выдать оборудование -->
    <div class="modal fade" id="chooseUsage" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Выдача оборудования</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p>Что выдаем?</p>
                        <div class="container  m-1">
                            <select class="form-select select-item" aria-label="Default select example">
                                <option selected>Выбрать</option>
                                <?php foreach ($inventory as $row) : ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['item_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <p>Кому выдаем?</p>
                        <div class="container m-1">
                            <select class="form-select select-employee" aria-label="Default select example">
                                <option selected>Выбрать</option>
                                <?php foreach ($employee as $row) : ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['full_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary item-add-btn">Выдать</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</body>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/usage.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


</html>