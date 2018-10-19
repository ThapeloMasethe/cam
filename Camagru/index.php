<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="./css/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <header>
        <h1>Camagru</h1>
    </header>
    <div class="main-container">
        <img src="./img/main.jpg" alt="main">
    </div>
    <div class="user-container">
        <form action="users.php" method="POST">
            <P>Already have an account? Login below.</p>
            <input type="email" name="email" placeholder="email" required> <br>
            <input type="password" name="password" placeholder="password" required> <br>
            <input type="hidden" name="login" value="login">
            <button type="submit">LOGIN</button>
        </form>
        <hr>
        <form action="users.php" method="POST">
            <p>Create an account below.</p>
            <input type="email" name="email" placeholder="email" required> <br>
            <input type="text" name="firstname" placeholder="firstname" required> <br>
            <input type="text" name="lastname" placeholder="lastname" required> <br>
            <input type="text" name="username" placeholder="username" required> <br>
            <input type="tel" name="cellnumber" placeholder="Cellnumber" required> <br>
            <input type="password" name="password" placeholder="Password" required> <br>
            <input type="hidden" name="signup" value="signup">
            <button type="submit">SIGNUP</button>
    </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>