<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SignUp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="users.php" method="POST">
        Email: <input type="email" name="email"> <br>
        Firstname: <input type="text" name="firstname"> <br>
        Lastname: <input type="text" name="lastname"> <br>
        Username: <input type="text" name="username"> <br>
        Cellnumber: <input type="tel" name="cellnumber"> <br>
        Password: <input type="password" name="password"> <br>
        <input type="hidden" name="signup" value="signup">
        <button type="submit">Signup</button>
    </form>
</body>
</html>