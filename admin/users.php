
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>User Management</title>
</head>
<body>
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
                            <a class="nav-link" href="/admin/users.php">Quản lý tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/products.php">Quản lý sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/comments.php">Đánh giá</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/loginPage.php">Đăng xuất</a>
                        </li>
                    </ul>
                </div>
            </div>

            <span>
            <?php echo '<span class="helloUser">Xin chào admin </span>' ?>
            </span>
        </nav> 
    </div>
    <div class="wrapper">
        <div id="content">
            <div class="cart-container">
                <div class="cart-title">
                    <span style="font-size: 24px">Quản lý tài khoản</span>
                </div>
                <div class="cart-header">
                    <div class="cart-image a-center" style="width: 5%">STT</div>
                    <div class="cart-name a-center" style="width: 25%">Họ và tên</div>
                    <div class="cart-price a-center" style="width: 15%">Tài khoản</div>
                    <div class="cart-number a-center" style="width: 15%">Số điện thoại</div>
                    <div class="cart-totalperItem a-center" style="width: 25%">Email</div>
                    <div class="cart-delete a-center" style="width: 15%">Thao tác</div>
                </div>
                <?php
                if (isset($_GET["id"])) {
                    require_once("../services/connect_db.php");
                    $id = $_GET["id"];
                    $query = "DELETE from db_user where ACCOUNT='$id'";
                    mysqli_query($connect, $query);
                    echo"<script>alert('Tài khoản $id đã bị xoá') </script>";
                }
                ?>
                <?php
                session_start();
                require_once("../services/connect_db.php");
                $query =  "SELECT * from db_user";
                $result = mysqli_query($connect, $query);
                $data = [];
                while ($row = mysqli_fetch_array($result, 1)) {
                $data[] = $row;
                }
                $connect->close();

                $index = 1;
                foreach ($data as $item) {
                echo
                '
                <div class="cart-header">
                    <div class="cart-image a-center" style="width: 5%">' . ($index++) . '</div>
                    <div class="cart-name a-center" style="width: 25%">' . $item['NAME'] . '</div>
                    <div class="cart-price a-center" style="width: 15%">' . $item['ACCOUNT'] . '</div>
                    <div class="cart-number a-center" style="width: 15%">' . $item['SDT'] . '</div>
                    <div class="cart-totalperItem a-center" style="width: 25%">' . $item['EMAIL'] . '</div>
                    <div class="cart-delete a-center" style="width: 15%"><a class="btn btn-secondary" href="?id=' . $item['ACCOUNT'] . '">Xóa</a></div>
                </div>
                ';
                };
            ?>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>





