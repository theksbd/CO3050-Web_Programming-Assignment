<?php
    require_once("services/connect_db.php");
    if (!isset($_SESSION["user"])){
        echo
        '
        <div class="account">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/index.php">ZFashion SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">                                 
              <a class="nav-link" href="/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/welcome.php">Giới thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/loginPage.php">Đăng nhập</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/registerPage.php">Đăng ký</a>
            </li>
          </ul>
        </div>
        <form class="form-inline" action="index.php" method="GET">
          <input class="form-control mr-sm-2" type="text" placeholder="Nhập vào sản phẩm" aria-label="Search" value="" name ="search"/>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Tìm">Tìm kiếm</button>
        </form>
      </nav> 
        </div> 
        ';
    }
    else {
        echo'
        <div class="account">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/index.php">ZFashion SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">                                 
              <a class="nav-link" href="/index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/welcome.php">Giới thiệu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/changeAccount.php">Thay đổi mật khẩu</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./services/logout.php">Đăng xuất</a>
            </li>
          </ul>
        </div>
        <span class="helloUser">Xin chào ' . $_SESSION["user"] . '&nbsp;&nbsp;</span>
        
        <span>
        <a href="/cart.php">
          <img style="width: 2rem; margin-right: 1rem;" src="/image/cart.png" />
        </a>
        </span>

        <form class="form-inline" action="index.php" method="GET">
          <input class="form-control mr-sm-2" type="text" placeholder="Nhập vào sản phẩm" aria-label="Search" value="" name ="search"/>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Tìm">Tìm kiếm</button>
        </form>
      </nav> 
        </div> 
        ';
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="css/navigation.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
</head>

<body>
</body>

</html>