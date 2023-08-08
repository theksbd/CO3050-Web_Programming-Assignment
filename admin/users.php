
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="css/user.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>User Management</title>
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>YG Shop</h3>
            </div>
            <ul class="list-unstyled components">
                <li>
                    <a href="/admin/users.php">Quản lý tài khoản</a>
                </li>
                <li>
                    <a href="/admin/products.php">Quản lý sản phẩm</a>
                </li>
                <li>
                    <a href="/admin/comments.php">Đánh giá</a>
                </li>
                <li>
                    <a href="/loginPage.php">Đăng xuất</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Menu</span>
                    </button>
                    <span>Xin chào: Admin</span>
                </div>
            </nav>
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
                    require_once("services/connect_db.php");
                    $id = $_GET["id"];
                    $query = "DELETE from db_user where ACCOUNT='$id'";
                    mysqli_query($connect, $query);
                    echo"<script>alert('Tài khoản $id đã bị xoá') </script>";
                }
                ?>
                <?php
                session_start();
                require_once("services/connect_db.php");
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
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>
</html>





