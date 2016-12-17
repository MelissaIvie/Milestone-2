<?php
include('login.php'); // Includes Login Script

// If the user is logged in, redirect to the game
if(isset($_SESSION['login_user'])){
  header("location: game.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Melissa's Game Login</title>
   <link rel="stylesheet" href="game.css">
</head>

<body>
    <h1>Melissa's Fabulous Game</h1>
    <div id="main">
        <?php
            if ($error != '') {
                echo '<div class="error">' . $error . "<div>";
            }
        ?>    
       
        <div id="login">
            <h2>Login Form</h2>
            <form action="" method="post">
                <ul>
                <li><label>Username :</label>
                <input id="name" name="username" placeholder="username" type="text"></li>
                <li><label>Password :</label>
                <input id="password" name="password" placeholder="**********" type="password"></li>
                <li><input name="submit" type="submit" value=" Login "></li>
                </ul>
            </form>
        </div>
    </div>
    <div>
       <ul> <a href="addNewUser.php">Click here to create a <button>New User</button>.</a><ul>
         
    </div>
</body>

</html>