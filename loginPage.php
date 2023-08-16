<?php
require_once 'config.php';

if (isset($_SESSION["user"])) {
  header("location: ./index.php");
  return;
}

$error_message = '';

if (isset($_POST['account'])) {
  $account = htmlspecialchars($_POST['account']);
  $pass = htmlspecialchars(md5($_POST['pass']));
  if ($account == "admin") {
    header("location: ./admin/index.php");
  } else {
    require_once("services/connect_db.php");
    $stmt = $connect->prepare('SELECT * FROM db_user WHERE ACCOUNT = ? AND PASS = ?');
    $stmt->bind_param('ss', $account, $pass);

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/login-register.css">
  <title>Đăng nhập</title>
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
        </div>
    </nav>
  </div> 

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
  
  <?php require_once "layout/footer.php" ?>
</body>

</html>