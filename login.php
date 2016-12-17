<?php
// Starting Session
session_start(); 

$error=''; // Variable To Store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username or Password is invalid";
    }
    else
    {
        // Pull $username and $password from the POST parameters
        $username=$_POST['username'];
        $password=$_POST['password'];

        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysql_connect("localhost", "clutzycoder", "");
        
        // Selecting Database
        $db = mysql_select_db("game", $connection);
        
        // Clean up the username and password to protect agaainst MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);

        // SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("select * from users where password='$password' AND username='$username'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            // Set the username in the session
            $_SESSION['login_user']=$username; 
        } else {
            $error = "Username or Password is invalid";
        }

        mysql_close($connection); // Closing Connection
    }
}

?>