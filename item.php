<?php
  session_start();
  require_once("services/connect_db.php");

  if(isset($_POST['content'])){
    require_once("services/connect_db.php");
    $productid = $_GET['id'];
    $account = $_SESSION["user"];
    $content = $_POST["content"];
    $commentQuery = "insert into comments(account,productid,date,content) values('$account',$productid,now(),'$content')";
    mysqli_query($connect, $commentQuery);
    echo"<script>alert('Your comment will appear soon') </script>";
  }
?>
<?php
  require_once("services/connect_db.php");
  $id = $_GET['id'];
  $query = "select * from db_products where id='$id'";
  $result = mysqli_query($connect, $query);
  $item = mysqli_fetch_array($result);
?>

    <!-- Script for quantity increase/decrease -->
    <script>
        function increment() {
            var value = parseInt(document.getElementById('demoInput').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('demoInput').value = value;
            document.getElementById('quantity').innerHTML= value;
            }
        function decrement() {
            var value = parseInt(document.getElementById('demoInput').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('demoInput').value = value;
            document.getElementById('quantity').innerHTML= value;
        }
    </script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/item.css">
    <title>Young Green</title>
</head>
<style>
    <?php include 'css/item.css'; ?>
    <?php include 'css/footer.css';?>
</style>
<body>
    <?php include"layout/navigation.php";?>
    
    <div class="container">
        <?php 
        echo
        '
            <div class="product-container">
                <img class="product-image" src="' . $item['image'] . '" alt="Card image cap" >
                <div class="product-content">
                    <a class="font-weight-bold content-name">' . $item['name'] . '</a>
                    <p class="content-price">'. $item['price'] .' VND</p>
                    <div class="content-size">
                        <a>Kích Thước:</a>    
                        <form class="boxed size-form">
                            <input type="radio" id="S-size" name="size" value="S" >
                            <label for="S-size">S</label>
                            <input type="radio" id="M-size" name="size" value="M" >
                            <label for="M-size">M</label>
                            <input type="radio" id="L-size" name="size" value="L" >
                            <label for="L-size">L</label>
                            <input type="radio" id="XL-size" name="size" value="XL" >
                            <label for="XL-size">XL</label>
                            <input type="radio" id="XXL-size" name="size" value="XXL" >
                            <label for="XXL-size">XXL</label>
                        </form>
                    </div>
                    <br>
                    <div class="content-quantity">
                        <a class="font-weight-bold">Số Lượng: <span id="quantity">1</span></a>
                    </div>
                    <div class="quantity-selector">
                        <div class="change-quantity">
                            <button class="quantity-btn" onclick="increment()">&#9650</button>
                            <button class="quantity-btn" onclick="decrement()">&#9660</button>
                        </div>
                        <div class="quantity-form">
                            <form method="POST" action="/cart.php?action=add" autocomplete="off">
                                <input id="demoInput" type="number" min=0 max=100 value="1" name="quantity[' . $item['id'] .']">
                                <input class="btn btn-secondary buy-btn" type="submit" value="mua sản phẩm">
                            </form>
                        </div>
                    </div>
                    </br>
                    </br>
                    <span class="font-weight-bold">Giới thiệu sản phẩm:</span>
                    <p class="content-description">'.$item['description'].'</p>
                </div>
            </div>
        ';
        ?>
        <div class="comment-container">
            <!-- show comment -->
            <?php
            require_once("services/connect_db.php");
            $productid = $_GET['id'];
            $getCommentsQuery = "select * from comments where productid = $productid";
            $allCommentsOfProducts = mysqli_query($connect, $getCommentsQuery);
            // $comments = 
            ?>
            <?php
            if(mysqli_num_rows($allCommentsOfProducts)==0):
            echo"<h2 style='color:green'>Không có đánh giá nào!</h2>";
            echo'
                    <section>
                    <form method="post" action="">
                        <section>
                        <textarea name="content" id="" cols="30" rows="3" style="width:100%" placeholder="Comment here"></textarea>
                        </section>
                        <section>
                        <input class="btn btn-secondary submit-btn" type="submit" value="Gửi đánh giá">
                        </section>
                    </form>
                    </section>
                    ';
            else:
            ?>
            <div class="comment-header">
                <h3>Đánh giá sản phẩm: </h2>
                <h3 class="comment-number" style="font-style:italic">(<?=mysqli_num_rows($allCommentsOfProducts)?> đánh giá)</h3>
            </div>
            <!-- comment -->
            <?php
                if(isset($_SESSION["user"])){
                echo'
                    <section>
                    <form method="post" action="">
                        <section>
                        <textarea name="content" id="" cols="30" rows="3" style="width:100%" placeholder="Comment here"></textarea>
                        </section>
                        <section>
                        <input class="btn btn-secondary submit-btn" type="submit" value="Gửi đánh giá">
                        </section>
                    </form>
                    </section>
                    ';
                }
                ?>
            <?php
            foreach($allCommentsOfProducts as $comment):
            ?>
            <div class="comment-content">
                <section style='font-weight:bold;' >Tài khoản: <span><?=$comment['account']?></span></section>
                <section style='padding-left:1%;' >Nội dung đánh giá: <?=$comment['content']?></section>
            </div>
            <?php
            endforeach;
            endif;
            $connect->close();
            ?>
            
        </div>
    </div>
<?php include 'layout/footer.php'; ?>
</body>
</html>