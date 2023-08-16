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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <link rel="stylesheet" href="css/product.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
    integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
  </script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
    integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
  </script>
  <title>Product Management</title>
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
  </script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
  </script>
  <div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3>ZFashion Shop</h3>
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
                    require_once("services/connect_db.php");
                    $query =  "SELECT * from db_products";
                    $result = mysqli_query($connect, $query);
                    $data = [];
                    while ($row = mysqli_fetch_array($result, 1)) {
                    $data[] = $row;
                    }
                    $index = 1;
                    foreach ($data as $item) {
                    echo
                    '
                    <div class="cart-header">
                        <div class="cart-image a-center" style="width: 5%">' . $item['id'] . '</div>
                        <div class="cart-name a-center" style="width: 30%">' . $item['name'] . '</div>
                        <div class="cart-price a-center" style="width: 10%">' . $item['price'] . '</div>
                        <div class="cart-number a-center" style="width: 20%"><img style="width: 70%;
                        height: 90%"src="' . $item['image'] . '"></div>
                        <div class="cart-totalperItem a-center" style="width: 25%; padding:1%;">' . $item['description'] . '</div>
                        <div class="cart-delete a-center" style="width: 15%">
                            <a class="btn btn-primary update-button" href="update.php?id=' . $item['id'] . '">Cập nhật</a>
                            <a class="btn btn-secondary delete-button" href="?id=' . $item['id'] . '">Xóa</a>
                        </div>
                    </div>
                    ';
                    };
                    ?>

        <button type="button" class="btn btn-secondary add-product" data-toggle="modal"
          data-target="#exampleModalCenter">Thêm sản phẩm</button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                  <div class="modal-info">
                    <input name="name" type="text" class="form-control" placeholder="Tên sản phẩm" required>
                  </div>
                  <div class="modal-info">
                    <input name="price" type="text" class="form-control" placeholder="Đơn giá" required>
                  </div>
                  <div class="modal-info">
                    <input name="image" type="text" class="form-control" placeholder="Link hình ảnh">
                  </div>
                  <div class="modal-info">
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
  <script>
  $(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
      $('#sidebar').toggleClass('active');
    });
  });
  </script>
</body>

</html>