<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- You can also include your custom CSS file here -->
</head>
<body>
    <form action="./lib/auth.php" method="POST">
        <h1>Login</h1>
        <label for="username">Username : </label><br>
        <input type="text" name="username" id="username"><br><br>
        
        <label for="password">Password : </label><br>
        <input type="password" name="password" id="password"><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <a href="./register.php">register?</a>
</body>
</html>