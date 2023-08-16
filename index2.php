<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZFASHION SHOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <!-- đăng nhập đăng kí -->
    <?php
        require_once 'config.php';

        if (!isset($_SESSION["user"])) {
    ?>
            <div class="account">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">ZFASHION SHOP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/index2.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/welcome2.php">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/loginPage2.php">Đăng nhập</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/registerPage2.php">Đăng ký</a>
                            </li>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div> 
    <?php
        } else {
    ?>
            <div class="account">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">ZFASHION SHOP</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/index2.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/welcome2.php">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/changeAccount2.php">Thay đổi mật khẩu</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="../services/logout2.php">Đăng xuất</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <span>
                    <?php echo '<span class="helloUser">Xin chào ' . $_SESSION["user"] . '</span>' ?>
                        <a href="/cart2.php">
                            <img style="width: 2rem; margin-right: 1rem;" src="image/cart.png" />
                        </a>
                    </span>
                </nav> 
            </div> 
    <?php
        }
    ?>


    <?php include "home2.php"; ?>
    <?php include "layout/footer2.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>