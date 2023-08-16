<?php
    $search = '';
    if (isset($_GET["search"])) {
        $search = htmlspecialchars($_GET["search"]);

        if ($search === "") {

            if (isset($_GET["page"])) {
                header("location: ./index2.php?page=" . $_GET["page"]);
            } else {
                header("location: ./index2.php");
            }
        }

        require_once("services/connect_db.php");
        $stmt = $connect->prepare('SELECT * FROM db_products WHERE NAME LIKE ?');
        $searchQuery ="%".$search."%";
        $stmt->bind_param('s',  $searchQuery);
        $stmt->execute();
        $fullProducts = $stmt->get_result();

        //paging
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }

        $productsPerPage = 7;
        $from = ($page-1) * $productsPerPage;
        // $fullProducts = mysqli_query($connect, $query);
        $totalPages = ceil(mysqli_num_rows($fullProducts) / $productsPerPage);

        $query2 = $connect->prepare('SELECT * FROM db_products WHERE NAME LIKE ? limit ?,?');
        $query2->bind_param('sss', $searchQuery, $from, $productsPerPage);
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

        //paging
        $page = 1;
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }

        $productsPerPage = 7;
        $from = ($page - 1) * $productsPerPage;
        $fullProducts = mysqli_query($connect, $query1);
        $totalPages = ceil(mysqli_num_rows($fullProducts) / $productsPerPage);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="css/home2.css">
</head>

<body>
</body>

</html>

<div class="container" style="margin-top: 2rem;">
    <div class="tim-kiem">
        <h5>Tìm sản phẩm bạn thích:</h5>
        <form class="row g-3" action="index2.php" method="GET">
            <div class="col-auto">
                <input type="text" class="form-control" placeholder="Tìm tên sản phẩm" aria-label="Search" value="" name ="search">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" value="Tìm">Tìm kiếm</button>
            </div>
        </form>
    </div>
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
        ?>
                <div class="card item-card product-item">
                    <a class="card-title" href="item2.php/?id=<?php echo $item['id'] ?>">
                        <div style="width:286.4px;height:300px;">
                            <?php echo '<img class="card-img-top" width="200px" height="300px" src="' . $item['image'] . '" alt="Card image cap">' ?>
                        </div>
                    </a>

                    <div class="card-body">
                        <a class="card-title" href="item2.php/?id=<?php echo $item['id'] ?>">
                            <?php echo '<p class="card-title font-weight-bold">' . $item['name'] . '</p>' ?>
                        </a>

                        <a class="card-title" href="item2.php/?id=<?php echo $item['id'] ?>">
                            <?php echo '<p class="card-text font-weight-bold">' . number_format($item['price']) . 'đ</p>' ?>
                        </a>

                        <a class="card-title" href="item2.php/?id=<?php echo $item['id'] ?>">
                            <?php echo '<p class="card-text">'.$item['description'].'</p>' ?>
                        </a>
                        <br/>

                        <form class="form-buy-now" method="POST" action="/cart2.php?action=add" autocomplete="off">
                            <?php echo '<input type="hidden" value="1" name="quantity[' . $item['id'] .']">' ?>
                            <input class="btn btn-primary" type="submit" value="Mua ngay">
                        </form>
                        
                        <button class="btn btn-outline-primary" onclick="addToCart(<?php echo $item['id'] ?>)">Thêm vào giỏ hàng</button>
                    </div>
                </div>
        <?php
            }        
        ?>
    </div>
    <script>
        const addToCart = (id) => {
            fetch('/cart2.php?action=add', {
                method: 'POST',
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
    <?php require_once "layout/pagination2.php";?>
</div>