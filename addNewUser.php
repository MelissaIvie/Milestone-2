<?php

// Initialize Session
session_start();

$error=''; // Variable To Store Error Message

// if the username has already been set (from a POST), add it to the database and go to the game
if(isset($_POST['username'])){
    require_once 'dbLogin.php';

    // Create connection
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    // Pull the username and password from the post form parameters
    $newUsername = $_POST['username'];
    $newPassword = $_POST['password'];
    
    // To protect MySQL injection for Security purpose strip slashes and escape the strings
    $newUsername = stripslashes($newUsername);
    $newPassword = stripslashes($newPassword);
    $newUsername = $conn->real_escape_string($newUsername);
    $newPassword = $conn->real_escape_string($newPassword);
    
    //echo "Username: " . $newUsername . "<br>";
    //echo "Password: " . $newPassword . "<br>";
    //echo "select * from login where username='$newUsername';" . "<br>";
    
    // Check that the username doesn't already exist
    $checkQuery = $conn->query("select * from users where username='$newUsername';");
    $checkRows = $checkQuery->num_rows;
    //echo "Number of rows matching username: " . $checkRows . "<br>";
    if ($checkRows > 0) {
        // Username already exists, return to same form and display error
        $error = "The username '" . $newUsername . "' already exists.";
        //echo $error . "<br>";
    } else {
        // Username doesn't exist, add it to the database, and go to the game page
    
        // Create the SQL to insert the username and password into the database
        $sql = "INSERT INTO users (username, password) VALUES ('" . 
            $newUsername . "', '" . $newPassword . "')";
    
        // If the query is successful, put the username in the session and go to the game
        if ($conn->query($sql) === TRUE) {

            // Put the currently logged in username into the session
            $_SESSION['login_user']=$newUsername; 
            // Redirect to the game
            header("location: game.php");
        } else {
            $error =  "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }

    // Close the connection to the database
    $conn->close();    
}

?>

<html>
    <head>
          <!-- Latest compiled and minified CSS -->
          <!-- Melissa, if you would like to use bootstrap uncomment the following line:
              <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
          -->
        
          <!-- Latest compiled and minified JavaScript -->
          <!-- Melissa, if you would like to use bootstrap uncomment the following line:
              <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
          -->
          
          <link rel="stylesheet" href="game.css">
    </head>

    <body>
        <?php
            if ($error != '') {
                echo '<div class="error">' . $error . "<div>";
            }
        ?>    
          <form action="" method="post">
                <label>UserName :</label>
                <input id="name" name="username" placeholder="username" type="text"><br/>
                <label>Password :</label>
                <input id="password" name="password" placeholder="**********" type="password"><br/>
                 <label>Type PasswordAgain :</label>
                <input id="repeatPassword" name="repeatPassword" placeholder="**********" type="password"><br/>
                <input name="submit" type="submit" value=" Add User ">
            
            </form>
            
    </body>
</html>  
  