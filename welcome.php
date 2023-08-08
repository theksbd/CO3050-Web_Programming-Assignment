<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/welcome.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Giới thiệu</title>
</head>
<body>
    <?php 
    session_start();
    require_once("services/connect_db.php");
    if (!isset($_SESSION["user"])){
        echo
        '
        <div class="account">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/index.php">YG SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">                                 
              <a class="nav-link" href="/index.php">Home</a>
            </li>
            <li class="nav-item active">
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
        <a class="navbar-brand" href="/index.php">YG SHOP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">                                 
              <a class="nav-link" href="/index.php">Home</a>
            </li>
            <li class="nav-item active">
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
        <span class="helloUser">Xin chào ' . $_SESSION["user"] . '</span>

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

    <div class="content-container" style="margin-top: 2rem;">
        <div class="small-title">
            YG Shop - Ấn tượng với phong cách thời trang streetwear
        </div>  
        <img src="https://kenh14cdn.com/thumb_w/800/pr/2021/1614676628010-0-0-598-957-crop-1614676632489-63750301649062.jpg">
        <h3>Phong cách thời trang streetwear hay còn gọi là phong cách đường phố là một trong những xu hướng cực kỳ phổ biến và thịnh hành trên toàn cầu.
        </h3>
        <p>
        Đây là một trong những phong cách có nhiều sự ảnh hưởng đặc biệt là giới trẻ. Với các gam màu tiêu biểu xám, trắng và đen kèm theo thiết kế có phần bụi bặm đã giúp cho phong cách này có chỗ đứng nhất định trong làng thời trang cũng như có sức ảnh hưởng nhất định với việc ra đời của các thương hiệu thời trang nổi tiếng, và YG Shop là một trong những thương hiệu đó.
        </p>
        <img src="https://channel.mediacdn.vn/2021/3/2/photo-1-1614676236847485990229.jpg">
        <p>
        Được thành lập và chính thức đi vào hoạt động từ năm 2014, với các sản phẩm hướng tới các khách hàng trẻ có độ tuổi từ 14-30, có phong cách năng động, cá tính. Thương hiệu này không chỉ phát triển các sản phẩm quần áo mà còn chú trọng vào nhiều phụ kiện đi kèm như quần áo, backpack, nón…
        </p>
        <img src="https://channel.mediacdn.vn/2021/3/2/photo-1-16146762452871831379480.jpg">
        <p>
        Khi mới ra mắt, YG Shop gây ấn tượng bởi phong cách streetwear đơn giản và phóng khoáng. Các tín đồ thời trang có thể tự do thể hiện cá tính và tạo nên xu hướng mới. Vẻ "ngầu" tự nhiên cùng điểm nhấn trong phong cách streetwear đã giúp cho YG Shop chiếm được tình cảm của nhiều người, đặc biệt là các bạn trẻ.
        </p>
        <img src="https://channel.mediacdn.vn/2021/3/2/photo-2-1614676245294615325368.jpg" >
        <p>
        Các thiết kế tại YG Shop đều có tính ứng dụng cao, dễ dàng mix&match nhưng không vì thế mà trở nên nhạt nhòa, luôn có những chi tiết artwork đầy chất "nghệ" để bạn trông thật nổi bật, cá tính ở bất cứ nơi đâu. Và đây cũng là cách để làm nên dấu ấn mang tính đặc trưng của YG Shop trên thị trường.
        </p>
        <img src="https://channel.mediacdn.vn/2021/3/2/photo-3-16146762453011807255106.jpg" >
        <p>
        Thời trang nói lên cá tính của mỗi người và YG Shop cũng không ngoại lệ: "Khi xây dựng YG Shop điều đầu tiên mình nghĩ đến đó chính là khách hàng phải cảm thấy tự tin khi sử dụng sản phẩm thuộc brand của mình. Đó chắc chắn là một điều không thể tách rời. Tính đến thời điểm hiện tại, YG Shop là một thương hiệu mà khi khách hàng sử dụng sẽ cảm thấy thoải mái và tự tin với chất lượng sản phẩm, những outfit của YG Shop đủ đặc trưng, đủ khác biệt giữa rất nhiều streetwear brand trên thị trường." - Đại diện YG Shop nhấn mạnh.
        </p>
        <p>
        Đó là lý do vì sao các item của YG Shop được rất nhiều người ưa chuộng với những sáng tạo không ngừng. Những sản phẩm mới sau này với những ứng dụng mới như công nghệ in, chất liệu hiếm, thiết kế độc đáo khi ra mắt đều được các bạn trẻ ủng hộ.
        </p>
        <img src="https://channel.mediacdn.vn/2021/3/2/photo-4-1614676245307290940506.jpg" >
        <p>
        Bên cạnh chất lượng sản phẩm, dịch vụ cũng là một trong những yếu tố quan trọng mà YG Shop đặt lên hàng đầu, đội ngũ luôn lắng nghe khách hàng và cố gắng cải thiện mình qua từng ngày, vì hơn ai hết YG Shop hiểu rõ chính tình cảm, sự tin tưởng của các bạn là động lực để YG Shop phát triển và có chỗ đứng vững chắc như ngày hôm nay.
        </p>
        <p>
        Trong tương lai, giữ vững kim chỉ nam từ những ngày đầu thành lập, YG Shop sẽ luôn thay đổi mình để phù hợp với thị trường streetwear và cho ra lò những sản phẩm chất lượng cao cùng những thiết kế "đặc trưng" với giá cả hợp lý để tất cả các bạn trẻ Việt tự tin diện hàng ngày.
        </p>
    </div>
    

    <?php include"layout/footer.php" ?>
</body>
</html>