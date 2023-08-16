<?php
require_once 'config.php';

if (!isset($_SESSION["user"])) {
  header("location: ./index.php");
  return;
}

$account = $_SESSION["user"];
require_once("services/connect_db.php");
$error_message = '';
$success_message = '';
if (isset($_POST['oldpass'])) {
  $stmt = $connect->prepare('SELECT * from db_user where ACCOUNT= ? AND PASS=md5(?)');
  $oldpass = htmlspecialchars($_POST['oldpass']);
  $stmt->bind_param('ss', $account, $oldpass);
  $stmt->execute();
  $user = $stmt->get_result();
  if ($user->num_rows <= 0) {
    $error_message = "Bạn đã nhập sai mật khẩu cũ";
  } else {
    $newpass = htmlspecialchars($_POST['newpass']);
    $confirmpass = htmlspecialchars($_POST['confirmpass']);
    if ($newpass != $confirmpass) {
      $error_message = "Xác nhận mật khẩu mới không chính xác";
    } else {
      $stmt = $connect->prepare('UPDATE db_user set PASS=md5(?) where ACCOUNT=?');
      $stmt->bind_param('ss', $newpass, $account);
      $stmt->execute();
      $success_message = "Bạn đã đổi mật khẩu thành công";
    }
  }
  $connect->close();
}
require_once "layout/navigation.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/login-register.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Đổi mật khẩu</title>
</head>

<body>

<div class="login my-5 px-3 w-lg-25 container-fluid">
    <div>
      <h4>Xin chào <?= $_SESSION["user"] ?> , bạn đang đổi mật khẩu </h4>
    </div>
    <div>
      <form method="POST" action="changeAccount.php" autocomplete="off">
        <div class="form-group mb-4">
          <input name="oldpass" type="password" class="form-control" id="password1" placeholder="Old password..." required>
        </div>
        <div class="form-group mb-4">
          <input name="newpass" type="password" class="form-control" id="password1" placeholder="New password..." required>
        </div>
        <div class="form-group mb-4">
          <input name="confirmpass" type="password" class="form-control" id="password1" placeholder="Confirm new password..." required>
        </div>
        <div class="error-msg">
          <?php if ($error_message) echo $error_message; ?>
        </div>
        <div class="success-msg">
          <?php if ($success_message) echo $success_message; ?>
        </div>
        <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
      </form>
    </div>
  </div>

  <footer class="footer-container">
    <div class="container">
      <!--Bắt Đầu Nội Dung Giới Thiệu-->
      <div class="noi-dung about">
        <h2>ZFASHION SHOP</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
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