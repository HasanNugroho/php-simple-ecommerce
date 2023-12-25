<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- You can also include your custom CSS file here -->
</head>

<body>
<div class="container">
    <div class="card">
        <div class="row m-auto justify-content-center">
            <form action="./lib/auth.php" method="post" class="mt-4">
                <h1 class="mb-3">Register</h1>
                <div class="mb-3 text-left">
                    <label for="reg-username">Username:</label>
                    <input type="text" class="form-control" id="reg-username" name="username" required>
                </div>

                <div class="mb-3 text-left">
                    <label for="reg-password">Password:</label>
                    <input type="password" class="form-control" id="reg-password" name="password" required>
                </div>

                <div class="mb-3 text-left">
                    <label for="c_password">Confirm Password:</label>
                    <input type="password" class="form-control" id="c_password" name="c_password" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mb-3" name="register">Register</button>
                </div>
            </form>
        </div>
        <p class="text-center">Have an account? <a href="./login.php">Login</a></p>
    </div>
</div>
</body>

</html>