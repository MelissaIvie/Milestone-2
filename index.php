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
    
    <div class="centerDiv" id="login">
        <h1>Melissa's Fabulous Game</h1>
        <?php
            if ($error != '') {
                echo '<div class="error">' . $error . "<div>";
            }
        ?>    
       
        <div id="form">
            <h2>Login to Your Account</h2>
            <form action="" method="post">
                <table>
                    <tr>
                        <td><label>Username :</label></td>
                        <td><input id="name" name="username" placeholder="username" type="text"></td>
                    </tr>
                    <tr>
                        <td><label>Password :</label></td>
                        <td><input id="password" name="password" placeholder="**********" type="password"></td>
                    </tr>
                    <tr>
                        <td><input name="submit" type="submit" value=" Login " class="theButton"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div>
        <div>
           <a href="addNewUser.php" class="button">Click here to create a new user</a>
        </div>
    </div>

</body>

</html>