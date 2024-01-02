<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card text-center mt-5">
            <div class="row m-auto justify-content-center">
                <form action="./lib/auth.php" method="POST">
                    <h1 class="mb-3">Login</h1>

                    <div class="mb-3 text-left">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <div class="mb-3 text-left">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3" name="login">Login</button>
                </form>
            </div>
            <p>Don't have an account? <a href="./register.php">Register</a></p>
        </div>
    </div>
</body>

</html>