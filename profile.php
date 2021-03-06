<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: ../login.php');
};
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

<body>

    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                <use xlink:href="#bootstrap"></use>
            </svg>
        </a>

        <div class="col-md-3 text-end m-3">
            <a class="btn btn-danger" role="button" href="vendor/logout.php" class="logout">Выйти</a>
            <img src="<?= $_SESSION['user']['avatar'] ?>" width="100" alt="">
            <h2 style="margin: 10px 0;"><?= $_SESSION['user']['full_name'] ?></h2>
            <a href="#"><?= $_SESSION['user']['email'] ?></a>
        </div>
    </header>

    <div class="b-example-divider"></div>

    <main>

        <section class="py-1 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">МТК Росберг</h1>
                    <p class="lead text-muted">Выбирая продукцию от МТК Росберг - Вы выбираете лучшее!</p>
                </div>
            </div>
        </section>

        <div class="album py-2 bg-light">
            <div class="container text-center">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="text-center">
                                <img src="https://cdn.pixabay.com/photo/2020/10/01/17/11/store-5619201_960_720.jpg" class="img-fluid" alt="..." height="225">
                            </div>

                            <div class="card-body">
                                <p class="card-text">Перечень оборудования</p>
                                <div class="d-flex justify-content-center">

                                    <a class="btn btn-primary" href="inventory.php" role="button">Список</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="text-center">
                                <img src="https://img.freepik.com/free-photo/handsome-business-man-engineer-in-hard-hat-in-a-building_1303-21147.jpg?t=st=1651053816~exp=1651054416~hmac=ce1debf0b7572250e398624209df173d8d4c318a0a94752a65725b6f25f224d4&w=996" class="img-fluid" alt="..." height="225">
                            </div>

                            <div class="card-body">
                                <p class="card-text">Перечень сотрудников</p>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary" href="employess.html" role="button">Список</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="text-center">
                                <img src="https://img.freepik.com/free-photo/man-by-the-truck-guy-in-a-delivery-uniform-man-with-clipboard_1157-46192.jpg?t=st=1651051192~exp=1651051792~hmac=3ab923c3eedd3e3de86cdd41a8f09c16e11b228fa16e64aa142e6b67d2a73a8b&w=996" class="img-fluid" alt="..." height="225">
                            </div>

                            <div class="card-body">
                                <p class="card-text">Использование оборудования </p>
                                <div class="d-flex justify-content-center">
                                    <div class="d-flex justify-content-center">

                                        <a class="btn btn-primary" href="usage.php" role="button">Список</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

</html>