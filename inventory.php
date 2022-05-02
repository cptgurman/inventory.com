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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

</head>



<body>
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="profile.php" class="nav-link px-2 link-dark">Главная</a></li>
            <li><a href="inventory.php" class="nav-link px-2 link-secondary">Перечень оборудования</a></li>
            <li><a href="employees.php" class="nav-link px-2 link-dark">Перечень сотрудников</a></li>
            <li><a href="usage.php" class="nav-link px-2 link-dark">Использование оборудования</a></li>
        </ul>

        <div class="col-md-3 text-end p-2">
            <a><?php echo $_SESSION['user']["full_name"]; ?></a>
            <a class="btn btn-primary" href="vendor/logout.php" role="button">Выйти</a>
        </div>
    </header>
    <div class="container mb-2">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItem">Добавить
            оборудование</button>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Наименование оборудования</th>
                            <th scope="col">Код оборудования</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $row) : ?>
                            <tr id='<?php echo $row['id']; ?>'>
                                <td class='table-item' name='item-name'><a href="#"><?php echo $row['item_name']; ?></a></td>
                                <td class='table-item-code' name='item-code'><?php echo $row['code']; ?></td>
                                <td>
                                    <a href="usage.php?name=-1&item=<?php echo $row['id']; ?>&status=0" class="btn btn-primary" role="button">Сотрудники</a></i>
                                    <button type="button" class="btn btn-success editbtn" data-bs-toggle="modal" data-bs-target="#editItem"><i class="bi bi-pencil-square"></i></button>
                                    <button type="button" class="btn btn-danger deletebtn" data-bs-toggle="modal" data-bs-target="#deleteItem"><i class=" bi bi-x-circle-fill"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- Редактирование -->
    <div class="modal fade" id="editItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Редактирование</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Название</label>
                            <input type="text" class="form-control editName" id="exampleInputText1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Код</label>
                            <input type="text" class="form-control editCode" id="exampleInputText1">
                        </div>
                        <button type="submit" class="btn btn-primary saveEdit">Сохранить</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Удаление -->
    <div class="modal fade" id="deleteItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Удаление</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Вы действительно хотите удалить запись?
                    <p>Наименование: <span class="deleteItemName"></span></p>
                    <p>Код: <span class="deleteItemCode"></span></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-danger deletebtnaccept">Удалить</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Добавить оборудование -->
    <div class="modal fade" id="addItem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Добавление оборудования</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="exampleInputName" class="form-label">Название</label>
                            <input type="text" class="form-control" id="exampleInputText1" name="item_name">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputCode" class="form-label">Код</label>
                            <input type="input" class="form-control" id="exampleInputText1" name="item_code">
                        </div>
                        <button type="submit" class="btn btn-primary item-add-btn">Добавить</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/inventory.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>




</html>