<?php
    $search = '';
    if (isset($_GET["search"])) {
      $search = htmlspecialchars($_GET["search"]);

      if ($search === "") {
        header("location: ./index.php");
        return;
      }

      
      require_once("services/connect_db.php");
      $stmt = $connect->prepare('SELECT * FROM db_products WHERE NAME LIKE ?');
      $searchQuery ="%".$search."%";
    //   echo $searchQuery;
      $stmt->bind_param('s',  $searchQuery); // 's' specifies the variable type => 'string'
      $stmt->execute();
      $fullProducts = $stmt->get_result();
      //phantrang
      $page = 1;
      if(isset($_GET['page'])){
        $page = $_GET['page'];
      }
      $productsPerPage = 7;
      $from = ($page-1)*$productsPerPage;
      // $fullProducts = mysqli_query($connect, $query);
      $totalPages = ceil(mysqli_num_rows($fullProducts)/$productsPerPage);

      $query2 = $connect->prepare('SELECT * FROM db_products WHERE NAME LIKE ? limit ?,?');
      $query2->bind_param('sss', $searchQuery,$from,$productsPerPage); // 's' specifies the variable type => 'string'
      $query2->execute();
      $resultsearch = $query2->get_result();

      $datasearch = [];
      while ($row = mysqli_fetch_array($resultsearch, 1)) {
        $datasearch[] = $row;
      }
      $items = $datasearch;
      $connect->close();
    } else {
      require_once("services/connect_db.php");
      $query1 =  "SELECT * from db_products";
      // phan trang
      $page = 1;
      if(isset($_GET['page'])){
        $page = $_GET['page'];
      }
      $productsPerPage = 7;
      $from = ($page-1)*$productsPerPage;
      $fullProducts = mysqli_query($connect, $query1);
      $totalPages = ceil(mysqli_num_rows($fullProducts)/$productsPerPage);
      // printf($totalPages);

      $query1.=" limit $from,$productsPerPage";
      // query DB
      $result1 = mysqli_query($connect, $query1);
      if (!$result1) {
        printf("Error: %s\n", mysqli_error($connect));
        exit();
    }
      while ($row1 = mysqli_fetch_array($result1,1)) {
        $data[] = $row1;
      }
      $items = $data;
      $connect->close();
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
  <link rel="stylesheet" href="css/home.css">
</head>

<body>
</body>

</html>

<div class="container" style="margin-top: 2rem;">
  <div class="section-header">
    <?php
        if (!isset($_GET["search"]))
          echo
          '<h3>Sản phẩm</h3>
        </h3>';
        else {
          echo
          '<h3>Kết quả tìm kiếm: ' .$search. '</h3>';
        }
        ?>
  </div>
  <div class="owl-carousel new owl-theme">
    <div class="card-container">
      <?php
                foreach ($items as $item) {
                  echo
                  '
                      <div class="card item-card product-item">
                        <a class="card-title" href="item.php/?id='.$item['id'].'">
                          <img class="card-img-top" width="200px" height="300px" src="' . $item['image'] . '" alt="Card image cap">
                        </a>

                        <div class="card-body">
                          <a class="card-title" href="item.php/?id='.$item['id'].'">
                            <p class="card-title font-weight-bold">' . $item['name'] . '</p>
                          </a>

                          <a class="card-title" href="item.php/?id='.$item['id'].'">
                            <p class="card-text font-weight-bold">' . number_format($item['price']) . 'đ</p>
                          </a>

                          <a class="card-title" href="item.php/?id='.$item['id'].'">
                            <p class="card-text">'.$item['description'].'</p>
                          </a>
                          <br/>

                          <form class="form-buy-now" method="POST" action="/cart.php?action=add" autocomplete="off">
                          <input type="hidden" value="1" name="quantity[' . $item['id'] .']">
                          <input class="btn btn-primary" type="submit" value="Mua ngay">
                          </form>
                          
                          <button class="btn btn-secondary" onclick="addToCart('. $item['id'] .')">Thêm vào giỏ hàng</button>
                        </div>
                      </div>
                  ';
                }
                
                ?>
    </div>
    <script>
    const addToCart = (id) => {
      fetch('/cart.php?action=add', {
          method: 'POST', // or 'PUT'
          body: (() => {
            var formData = new FormData();
            formData.append(`quantity[${id}]`, 1);
            return formData;
          })()
        })
        .then(response => {
          alert("Thêm vào giỏ hàng thành công!");
        })
        .catch(error => {
          alert("Thêm vào giỏ hàng thất bại!");
        })
    }
    </script>
  </div>
</div>
</div>
<div>
  <?php include"layout/pagination.php";?>
</div>