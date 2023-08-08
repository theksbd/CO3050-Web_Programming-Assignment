<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/pagination.css">
</head>
<body>
    <nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php
            if ($search == "%%"){
                $search = "";
            }
        ?>
        <?php for($i=1;$i<=$totalPages;$i++):?>
        <li class="page-item <?=(empty($_GET['page'])&&$i==1||isset($_GET['page'])&&$i==$_GET['page'])?'highlight':''?>"><a class="page-link" href="?search=<?=$search?>&page=<?=$i?>"><?=$i?></a></li>
        <?php endfor?>
    </ul>
    </nav>
</body>
</html>