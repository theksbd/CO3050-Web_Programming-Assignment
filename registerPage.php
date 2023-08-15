<?php

session_start();
if (isset($_SESSION["user"])) {
  header("location: ./index.php");
  return;
}

$error_msgs = [
  'name' => 'Name must has 3-30 characters',
  'email' => 'Invalid email',
  'phone' => 'Phone number must be number only and has 10-11 characters',
  'account' => 'Account must has 3-30 characters',
  'password' => 'Password must has 3-30 characters',
  'confirm_pass' => 'Confirm passwod does not match password',
  'duplicate_account' => 'Account already exists, please enter a different account',
];

$error_codes = [];

function validate_form(&$error_codes, $name, $email, $phone, $account, $pass, $confirmpass)
{
  $email_filter =  '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
  $phone_number_filter = '/^[0-9]+$/';
  if (strlen($account) < 3 or strlen($account) > 30) {
    array_push($error_codes, 'account');
  }
  if (strlen($name) < 3 or strlen($name) > 30) {
    array_push($error_codes, 'name');
  }
  if (!preg_match($phone_number_filter, $phone) or strlen($phone) < 10 or strlen($phone) > 11) {
    array_push($error_codes, 'phone');
  }
  if (!preg_match($email_filter, $email)) {
    array_push($error_codes, 'email');
  }
  if (strlen($pass) < 3 or strlen($pass) > 30) {
    array_push($error_codes, 'password');
  }
  if ($pass !== $confirmpass) {
    array_push($error_codes, 'confirm_pass');
  }
  return count($error_codes) === 0;
}

if (isset($_POST['account'])) {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['phone']);
  $account = htmlspecialchars($_POST['account']);
  $pass = htmlspecialchars($_POST['pass']);
  $confirmpass = htmlspecialchars($_POST['confirmpass']);

  if (validate_form($error_codes, $name, $email, $phone, $account, $pass, $confirmpass)) {
    require_once("services/connect_db.php");
    $stmt = $connect->prepare('INSERT into db_user(NAME,EMAIL,SDT,ACCOUNT,PASS) values(?,?,?,?,md5(?))');
    $stmt->bind_param('sssss', $name, $email, $phone, $account, $pass); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
      if (strpos(mysqli_error($connect), "Duplicate entry '$account' for key 'PRIMARY'") !== FALSE) {
        array_push($error_codes, 'duplicate_account');
      } else {
        session_start();
        $_SESSION["user"] = $account;
        header("location: index.php");
      }
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/login-register.css">
  <title>Đăng kí</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/index.php">ZFashion SHOP</a>
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
        <li class="nav-item">
          <a class="nav-link" href="/loginPage.php">Đăng nhập</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/loginPage.php">Đăng ký</a>
        </li>
      </ul>
    </div>
    <form class="form-inline" action="index.php" method="GET">
      <input class="form-control mr-sm-2" type="text" placeholder="Nhập vào sản phẩm" aria-label="Search" value=""
        name="search" />
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Tìm">Tìm kiếm</button>
    </form>
  </nav>
  <div class="register my-5 px-3 w-lg-25 container-fluid">
    <div class="mx-auto text-center">
      <h3 class="mb-0">Đăng kí</h3>
    </div>
    <div>

      <form method="POST" action="registerPage.php" autocomplete="off">
        <div class="form-group">
          <div class="label">Tên</div>
          <input name="name" type="text" class="form-control" placeholder="Nhập tên của bạn" value="<?php
                                                                                                if (isset($_POST['name']) and $_POST['name'] !== '')
                                                                                                  echo htmlspecialchars($_POST['name']);
                                                                                                ?>" required>
          <div class="error-msg"><?php if (in_array('name', $error_codes)) echo $error_msgs['name']; ?></div>
        </div>
        <div class="form-group">
          <div class="label">Email</div>
          <input name="email" type="email" class="form-control" placeholder="Nhập email của bạn" value="<?php
                                                                                                            if (isset($_POST['email']) and $_POST['email'] !== '') echo htmlspecialchars($_POST['email']);
                                                                                                            ?>"
            required>
          <div class="error-msg"><?php if (in_array('email', $error_codes)) echo $error_msgs['email']; ?></div>
        </div>
        <div class="form-group">
          <div class="label">Số điện thoại</div>
          <input name="phone" type="text" class="form-control" placeholder="Nhập số điện thoại của bạn" value="<?php
                                                                                                          if (isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']);
                                                                                                          ?>" required>
          <div class="error-msg"><?php if (in_array('phone', $error_codes)) echo $error_msgs['phone']; ?></div>
        </div>
        <div class="form-group">
          <div class="label">Username</div>
          <input name="account" type="text" class="form-control" placeholder="Nhập username của bạn" value="<?php
                                                                                                        if (isset($_POST['account'])) echo htmlspecialchars($_POST['account']);
                                                                                                        ?>" required>
          <div class="error-msg">
            <?php
            if (in_array('account', $error_codes)) {
              echo $error_msgs['account'];
            } else if (in_array('duplicate_account', $error_codes)) {
              echo $error_msgs['duplicate_account'];
            }
            ?>
          </div>
        </div>
        <div class="form-group">
          <div class="label">Mật khẩu</div>
          <input name="pass" type="password" class="form-control" placeholder="Nhập mật khẩu của bạn" required>
          <div class="error-msg"><?php if (in_array('password', $error_codes)) echo $error_msgs['password']; ?></div>
        </div>
        <div class="form-group">
          <div class="label">Xác thực mật khẩu</div>
          <input name="confirmpass" type="password" class="form-control" placeholder="Nhập lại mật khẩu" required>
          <div class="error-msg"><?php if (in_array('confirm_pass', $error_codes)) echo $error_msgs['confirm_pass']; ?>
          </div>
        </div>
        <div class="btn-wrapper">
          <button class="btn btn-primary mb-2" type="submit">Đăng ký</button>
        </div>
      </form>
    </div>
  </div>
  <footer class="footer-container">
    <div class="container">
      <!--Bắt Đầu Nội Dung Giới Thiệu-->
      <div class="noi-dung about">
        <h2>ZFashion SHOP</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
          industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
          scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into
          electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of
          Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
          PageMaker including versions of Lorem Ipsum.</p>
        <!-- <ul class="social-icon">
          <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
          <li><a href=""><i class="fa fa-twitter" target="_blank"></i></a></li>
          <li><a href=""><i class="fa fa-instagram" target="_blank"></i></a></li>
          <li><a href="https://www.youtube.com" target="_blank"><i class="fa fa-youtube"></i></a></li>
        </ul> -->
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
            <span>268 Lý Thường Kiệt<br />
              Quận 10, Thành Phố Hồ Chí Minh<br />
              Việt Nam</span>
          </li>
          <li>
            <span><i class="fa fa-phone"></i></span>
            <p><a href="#">+84 xxx xxx xxx</a>
              <br />
              <a href="#">+84 xxx xxx xxx</a>
            </p>
          </li>
          <li>
            <span><i class="fa fa-envelope"></i></span>
            <p><a href="#">hoang@gmail.com</a></p>
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