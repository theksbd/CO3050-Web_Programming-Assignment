<?php

require_once 'config.php';
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/login-register.css">
  <title>Đăng kí</title>
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
  <div class="register my-5 px-3 w-lg-25 container-fluid">
    <div class="mx-auto text-center">
      <h3 class="mb-0">Đăng kí</h3>
    </div>
    <div>

      <form method="POST" action="registerPage2.php" autocomplete="off">
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
            ?>" required>
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
  
  <?php require_once "layout/footer2.php" ?>
</body>

</html>