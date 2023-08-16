<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZFASHION SHOP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <?php
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
                        <a href="/cart.php">
                            <img style="width: 2rem; margin-right: 1rem;" src="../image/cart.png" />
                        </a>
                    </span>
                </nav> 
            </div> 
    <?php
        }
    ?>
</body>
