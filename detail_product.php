<?php
session_start();
require('./koneksi.php');

if (!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
}

$id = $_GET['id'];
$query = mysqli_query($conn, "select * from products where id='$id'");
$data = $query->fetch_array();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ecommerce</title>
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Ecommerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php">Home</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item pr-3">
                            <a class="nav-link" aria-current="page" href="./product_list.php">Product</a>
                        </li>
                        <li class="nav-item pr-3">
                            <a class="nav-link" aria-current="page" href="./cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <?php if (!isset($_SESSION["user_id"])){?>
                                <a class="btn btn-outline-success" href="./login.php">Login</a>
                            <?php } else {?>
                                <a class="btn btn-outline-danger" href="./lib/logout.php">Logout</a>
                            <?php }?>
                        </li>
                        <li class="nav-item pr-3">
                            <a class="nav-link" aria-current="page" href="#"><?php echo $_SESSION["username"]; ?></a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
    <!-- end navbar -->
    <!-- product -->
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4">
                <img src="https://dummyimage.com/350x350/000/fff.png&text=<?php echo $data['name'];?>">
            </div>
            <div class="col-md-8">
                <h3 class="text-title"><?php echo $data['name'];?></h3>
                <h4>Rp.<?php echo $data['price'];?></h4>
                <p><?php echo $data['description'];?></p>
                <p class="text-muted">Stock : <?php echo $data['stock'];?></p>
                <!-- Add an input field for the quantity -->
                <form action="./lib/cart.php" method="get">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" name="qty" value="1" max="<?php echo $data['stock'];?>" required>
                    </div>

                    <!-- Pass the product ID as a parameter -->
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?php echo $data['id'];?>">
                    <button type="submit" class="btn btn-primary">Add to cart</button>
                </form>
                <!-- <a href="./lib/cart.php?action=add&product_id=<?php echo $data['id'];?>" class="btn btn-primary">Add to cart</a> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>