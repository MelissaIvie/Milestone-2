<?php
session_start();
if(session_destroy()) // Destroy the current session
{
    header("Location: index.php"); // Redirect to Home Page
}
?>