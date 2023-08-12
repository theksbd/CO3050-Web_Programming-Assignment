<?php
session_start();

if (isset($_SESSION["user"])) {
  header("location: ./index.php");
  return;
}

$error_message = '';

if (isset($_POST['account'])) {
  $account = htmlspecialchars($_POST['account']);
  $pass = htmlspecialchars(md5($_POST['pass']));
  if ($account == "admin") {
    header("location: ./admin");
  } else {
    require_once("services/connect_db.php");
    $stmt = $connect->prepare('SELECT * FROM db_user WHERE ACCOUNT = ? AND PASS = ?');
    $stmt->bind_param('ss', $account, $pass); // 's' specifies the variable type => 'string'

    $stmt->execute();

    $result = $stmt->get_result();
    if (mysqli_num_rows($result) > 0) {
      $_SESSION["user"] = $account;
      header("location: ./index.php");
    } else {
      $error_message = "Bạn nhập sai tài khoản hoặc mật khẩu.";
    }
    $connect->close();
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/login-register.css">
  <title>Đăng nhập</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">YG SHOP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/welcome.php">Giới thiệu</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/loginPage.php">Đăng nhập</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/registerPage.php">Đăng ký</a>
        </li>
      </ul>
    </div>
    <form class="form-inline" action="index.php" method="GET">
      <input class="form-control mr-sm-2" type="text" placeholder="Nhập vào sản phẩm" aria-label="Search" value=""
        name="search" />
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Tìm">Tìm kiếm</button>
    </form>
  </nav>

  <div class="login my-5 px-3 w-lg-25 container-fluid">
    <div class="mx-auto text-center">
      <h3 class="mb-0">Đăng nhập</h3>
    </div>
    <div>
      <form method="POST" action="loginPage.php" autocomplete="off">
        <div class="form-group mb-4">
          <div class="label">Username</div>
          <input name="account" type="text" class="form-control" id="email1" placeholder="Nhập username của bạn" value="<?php
                                                                                                                  if (isset($_POST['account']) and $_POST['account'] !== '') {
                                                                                                                    echo htmlspecialchars($_POST['account']);
                                                                                                                  }
                                                                                                                  ?>"
            required>
        </div>
        <div class="form-group">
          <div class="label">Mật khẩu</div>
          <input name="pass" type="password" class="form-control" id="password1" placeholder="Nhập mật khẩu của bạn"
            required>
        </div>
        <div class="error-msg">
          <?php
          if ($error_message !== '') {
            echo $error_message;
          }
          ?>
        </div>
        <div class="btn-wrapper">
          <button type="submit" class="btn btn-primary mb-2">Đăng nhập</button>
        </div>
      </form>
    </div>
  </div>
  <footer class="footer-container">
    <div class="container">
      <!--Bắt Đầu Nội Dung Giới Thiệu-->
      <div class="noi-dung about">
        <h2>YOUNG GREEN</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
          industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
          scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
          electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
          Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
          PageMaker including versions of Lorem Ipsum.</p>
        <ul class="social-icon">
          <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li><a href=""><i class="fa fa-twitter" target="_blank"></i></a></li>
          <li><a href=""><i class="fa fa-instagram" target="_blank"></i></a></li>
          <li><a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a></li>
        </ul>
      </div>
      <!--Kết Thúc Nội Dung Giới Thiệu-->
      <!--Bắt Đầu Nội Dung Đường Dẫn-->
      <div class="noi-dung links">
        <h2>Thông tin</h2>
        <ul>
          <li><a href="./index.php">Trang Chủ</a></li>
          <li><a href="#">Danh sách cửa hàng</a></li>
          <li><a href="#">Shopee TPHCM</a></li>
          <li><a href="#">Shopee Hà Nội</a></li>
        </ul>
      </div>
      <div class="noi-dung links">
        <h2>Chính sách</h2>
        <ul>
          <li><a href="#">Chính sách đổi trả</a></li>
          <li><a href="#">Chính sách bảo hành</a></li>
          <li><a href="#">Chính sách hội viên</a></li>
          <li><a href="#">Chính sách giao nhận</a></li>
          <li><a href="#">Hướng dẫn mua hàng</a></li>
          <li><a href="#">Hướng dẫn thanh toán</a></li>
          <li><a href="#">Chính sách bảo mật</a></li>
        </ul>
      </div>
      <!--Kết Thúc Nội Dung Đường Dẫn-->
      <!--Bắt Đâu Nội Dung Liên Hệ-->
      <div class="noi-dung contact">
        <h2>Thông Tin Liên Hệ</h2>
        <ul class="info">
          <li>
            <span><i class="fa fa-map-marker"></i></span>
            <span>Đường Số 1<br />
              Quận 1, Thành Phố Hồ Chí Minh<br />
              Việt Nam</span>
          </li>
          <li>
            <span><i class="fa fa-phone"></i></span>
            <p><a href="#">+84 123 456 789</a>
              <br />
              <a href="#">+84 987 654 321</a>
            </p>
          </li>
          <li>
            <span><i class="fa fa-envelope"></i></span>
            <p><a href="#">diachiemail@gmail.com</a></p>
          </li>
          <li>
            <form class="form">
              <input type="email" class="form__field" placeholder="Đăng Ký Subscribe Email" />
              <button type="button" class="btn btn--primary  uppercase">Gửi</button>
            </form>
          </li>
        </ul>
      </div>
      <!--Kết Thúc Nội Dung Liên Hệ-->
    </div>
  </footer>
</body>

</html>