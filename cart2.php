<?php
require_once 'config.php';

if (!isset($_SESSION["user"])) {
	$_SESSION["cart"] = array();
	header ("Location: ./loginPage2.php");
}

if (!isset($_SESSION["cart"])){
$_SESSION["cart"] = array();
}

if (isset($_GET['action'])) {
switch($_GET['action']){
	case "add":
		foreach ($_POST['quantity'] as $id => $quantity){
			if(isset($_SESSION["cart"][$id])){
				$_SESSION["cart"][$id] += $quantity;	
			}else{
				$_SESSION["cart"][$id] = $quantity;
			}
		}
		break;
	case "delete":
		if (isset($_GET['id'])) {
			unset($_SESSION["cart"][$_GET['id']]);
		}
		header("location: ./cart2.php");
		break;
	case "submit":
		if (isset($_POST['update'])) {
			foreach ($_POST['quantity'] as $id => $quantity){
				$_SESSION["cart"][$id] = $quantity;
			}
		}
		if (isset($_POST['order'])) {
			foreach ($_POST['quantity'] as $id => $quantity){
				unset($_SESSION["cart"][$id]);
			}
		}
		header("location: ./cart2.php");
		break;
}    
}

if(!empty($_SESSION["cart"])){
	require_once("services/connect_db.php");
	//$_SESSION["cart"] = array(); 
	//var_dump($_SESSION["cart"]);exit;
	$query = "select * from db_products where id IN (".implode(",",array_keys(($_SESSION["cart"]))).")";
	$result = mysqli_query($connect, $query);
	while ($row1 = mysqli_fetch_array($result,1)) {
		$data[] = $row1;
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/cart.css">
  <link rel="stylesheet" href="css/footer.css">
  <title>Giỏ hàng</title>
</head>

<body>

  <?php include"./layout/navigation2.php";?>

  <div class="container">

    <div class="cart-container">
      <div class="cart-title">
        <span style="font-size: 24px">Giỏ hàng của bạn</span>
      </div>

      <div class="cart-header">
        <div class="cart-name a-center" style="width: 50%">Sản phẩm</div>
        <div class="cart-name a-center" style="width: 17%">Đơn giá</div>
        <div class="cart-number a-center" style="width: 14%">Số lượng</div>
        <div class="cart-totalperItem a-center" style="width: 14%">Thành tiền</div>
        <div class="cart-delete a-center" style="width: 7%"></div>
      </div>

      <form method="POST" action="cart2.php?action=submit" autocomplete="off">
        <?php
				$totalMoney = 0;
				if(!empty($data)){
					$qtyId = 1000;
					foreach($data as $item){
						echo
						'
						<div class="cart-body">
							<div class="cart-name a-left" style="width: 50%">
								<img class="my-img" src="' . $item['image'] . '" alt="Card image cap" >
								<div class="cart-product-name">
									<a href="item2.php/?id='.$item['id'].'">' . $item['name'] . '</a>
								</div>
							</div>
							
							<div class="cart-price a-center" style="width: 17%">'.  number_format($item['price']) .' VND</div>
							
							<div class="cart-number a-center quantity buttons_added" style="width: 14%">
								<input min=1 max=99 step=1 type="number" value="'.$_SESSION["cart"][$item['id']] .'" name="quantity['.$item['id'].']" id="quantity['.$item['id'].']" class="input-text qty text size="4"></input>
							</div>
							
							<div class="cart-totalperItem a-center" style="width: 14%">'. number_format($item['price'] * $_SESSION["cart"][$item['id']]) .' VND</div>
							<div class="cart-delete a-center" style="width: 7%">
								<a href="cart2.php?action=delete&id='.$item['id'].'"> Xóa </a>
							</div>
						</div>
						';
						$totalMoney += $item['price'] * $_SESSION["cart"][$item['id']];
						$qtyId++;
					}
				}
			?>

        <div class="total">
          <div class="continue-shopping">
            <a href="/index2.php" class="btn btn-outline-success">Tiếp tục mua hàng</a>
          </div>

          <div class="confirm-cart">
            <span style="font-size: 24px">Tổng tiền thanh toán:</span>
            <p style="font-size: 40px; color: #FFAC4B"><?=number_format($totalMoney)?> VND</p>
            <input class="btn btn-outline-primary submit-btn" type="submit" name="update" value="Cập nhật đơn hàng" />
            <input class="btn btn-primary submit-btn" type="submit" name="order" value="Tiến hành đặt hàng" />
          </div>
        </div>

      </form>
    </div>

  </div>

  <?php include 'layout/footer2.php'; ?>

</body>

</html>