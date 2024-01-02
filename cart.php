<?php
session_start();
if (!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
}
require('./lib/CartManager.php');
$cart = new CartManager();
$data = $cart->get_carts($_SESSION['user_id']);
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
                            <a class="nav-link active" aria-current="page" href="./cart.php">Cart</a>
                        </li>
                        <li class="nav-item pr-3">
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
        <div class="mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama produk</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Total</th>
                        <th scope="col">Act</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($data as $index => $d){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $index; ?></th>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo $d['qty']; ?></td>
                        <td><?php echo $d['price']; ?></td>
                        <td><?php echo $d['subtotal']; ?></td>
                        <td>
                            <a href="#" class="btn btn-success" >Checkout</a>
                            <a href="./lib/cart.php?action=delete&x=<?php echo $d['id']; ?>" class="btn btn-danger" >Drop</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>