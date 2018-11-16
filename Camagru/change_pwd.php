<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <script src="main.js"></script>
</head>
<body>
    <header>
        <h1>Camagru</h1>
    </header>
   <div class="activation">
        <h3>Change Password</h3>
        <p>Your are about to change your passwords.</p>
        <form action="users.php" method="POST">
            <input type="hidden" name="confirmation" value="confirmation">
            <input type="submit"  name="confirmation" value="Confirm">
            <!-- <button class="photo">Activate</button> -->
        </form>
   </div>
    <?php include('./includes/footer.php'); ?>                                                                                                                                                                                                                              
</body>