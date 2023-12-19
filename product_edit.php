<?php
session_start();
require('./koneksi.php');
if (!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
}

$userId = $_SESSION['user_id'];
$id = $_GET['id'];
$query = mysqli_query($conn, "select * from products where id='$id' and user_id = '$userId'");
$data = $query->fetch_array();

if (!isset($data)) {
    header("Location: ./product_list.php");
}

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
                            <a class="nav-link active" aria-current="page" href="./product_list.php">Product</a>
                        </li>
                        <li class="nav-item pr-3">
                            <a class="nav-link " aria-current="page" href="./cart.php">Cart</a>
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
            <h3>Update <?php echo $data['name'];?></h3>
            <form method="post" action="./lib/product_process.php?action=update">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                    <div class="form-group">
                        <label for="code">Product Code:</label>
                        <input type="text" class="form-control" name="code" value="<?php echo $data['code'];?>"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="name">Product Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $data['name'];?>" required>
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" name="price" value="<?php echo $data['price'];?>" required>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock Quantity:</label>
                        <input type="number" class="form-control" name="stock" value="<?php echo $data['stock'];?>" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description"><?php echo $data['description'];?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>