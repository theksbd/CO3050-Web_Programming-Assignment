<?php
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $image = $_POST['image'];
        $description = $_POST['description'];
        require_once("services/connect_db.php");
        $query1 = "INSERT into db_products(name,price,image,description) 
        values('".$name."','".$price."','".$image."','" . $description . "') ";
        $result1 = mysqli_query($connect, $query1);
        echo"<script>alert('Sản phẩm đã được thêm !') </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/product.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>Product Management</title>
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

            <span class="helloUser">Xin chào admin </span>
        </nav> 
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <div class="wrapper">
        <div id="content">
            <div class="cart-container">
                <div class="cart-title">
                    <span style="font-size: 24px">Quản lý sản phẩm</span>
                </div>
                <div class="cart-header">
                    <div class="cart-image a-center" style="width: 5%">ID</div>
                    <div class="cart-name a-center" style="width: 30%">Sản phẩm</div>
                    <div class="cart-price a-center" style="width: 10%">Đơn giá</div>
                    <div class="cart-number a-center" style="width: 20%">Hình ảnh</div>
                    <div class="cart-totalperItem a-center" style="width: 25%">Mô tả sản phẩm</div>
                    <div class="cart-delete a-center" style="width: 15%">Thao tác</div>
                </div>
                <?php
                    if (isset($_GET["id"])) {
                        require_once("../services/connect_db.php");
                        $id = $_GET["id"];
                        $query = "DELETE from db_products where id='$id'";
                        mysqli_query($connect, $query);
                        echo"<script>alert('Sản phẩm $id đã bị xoá') </script>";
                    }
                ?>
                <?php
                    session_start();
                    require_once("../services/connect_db.php");
                    $query =  "SELECT * from db_products";
                    $result = mysqli_query($connect, $query);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, 1)) {
                        $data[] = $row;
                    }
                    $index = 1;
                    foreach ($data as $item) {
                ?>
                    <div class="cart-header">
                        <div class="cart-image a-center" style="width: 5%"><?php echo $item['id'] ?></div>
                        <div class="cart-name a-center" style="width: 30%"><?php echo $item['name'] ?></div>
                        <div class="cart-price a-center" style="width: 10%"><?php echo $item['price'] ?></div>
                        <div class="cart-number a-center" style="width: 20%"><img style="width: 70%;
                        height: 90%"src="<?php echo $item['image'] ?>"></div>
                        <div class="cart-totalperItem a-center" style="width: 25%; padding:1%;"><?php echo $item['description'] ?></div>
                        <div class="cart-delete a-center" style="width: 15%">
                            <a class="btn btn-primary update-button" href="update.php?id=<?php echo $item['id'] ?>">Cập nhật</a>
                            <a class="btn btn-secondary delete-button" href="?id=<?php echo $item['id'] ?>">Xóa</a>
                        </div>
                    </div>
                <?php
                    }
                ?>

                    <button type="button" class="btn btn-primary add-product" data-toggle="modal" data-target="#exampleModalCenter" style="margin-top:30px;">Thêm sản phẩm</button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm sản phẩm mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="products.php" autocomplete="off">
                                <div class="modal-info" >
                                    <input name="name" type="text" class="form-control" placeholder="Tên sản phẩm" required>
                                </div>
                                <div  class="modal-info">
                                    <input name="price" type="text" class="form-control" placeholder="Đơn giá" required>
                                </div>
                                <div class="modal-info">
                                    <input name="image" type="text" class="form-control" placeholder="Link hình ảnh">
                                </div>
                                <div  class="modal-info">
                                    <input name="description" type="text" class="form-control" placeholder="Mô tả sản phẩm" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                                </div>                        
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
            </div> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>





