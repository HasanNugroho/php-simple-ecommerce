<?php
session_start();
if (!isset($_SESSION["user_id"])){
    header("Location: ./login.php");
}
require('./lib/Product.php');
$product = new Product();

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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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
        <div class="row mt-4">
            <?php
            $data = $product->get_public_products();
            if (is_array($data) || is_object($data)) {
            foreach($data as $d) {
            ?>
            <a href="./detail_product.php?id=<?php echo $d['id']; ?>" class="text-decoration-none col-md-4">
                <!-- <div class=""> -->
                <div class="card" style="width: 18rem;">
                    <img src="https://dummyimage.com/350x350/000/fff.png&text=<?php echo $d['name']; ?>"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-dark"><?php echo $d['name']; ?></h5>
                        <h6 class="card-text text-dark">Rp.<?php echo $d['price']; ?></h6>
                    </div>
                </div>
                <!-- </div> -->
            </a>
            <?php } } else {?>
                <div class="text-center">Produk tidak tersedia</div>
            <?php }?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>