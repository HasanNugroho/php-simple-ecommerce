<?php
session_start();
require('./koneksi.php');
if (!isset($_SESSION['user_id'])){
    header("Location: ./login.php");
}
$userId = $_SESSION['user_id'];
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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah data
            </button>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama produk</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Act</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($conn,"select * from products where user_id = '$userId'");
                    while($d = mysqli_fetch_assoc($data)){
                    ?>
                    </tr>
                        <th scope="row"><?php echo $d['code']; ?></th>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo $d['stock']; ?></td>
                        <td><?php echo $d['price']; ?></td>
                        <td><?php echo $d['description']; ?></td>
                        <td>
                            <a href="./product_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="./lib/product_process.php?action=delete&x=<?php echo $d['id']; ?>" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="./lib/product_process.php?action=add">
                <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Product Code:</label>
                            <input type="text" class="form-control" name="code" required>
                        </div>

                        <div class="form-group">
                            <label for="name">Product Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" name="price" required>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock Quantity:</label>
                            <input type="number" class="form-control" name="stock" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>