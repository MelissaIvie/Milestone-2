<?php
// Initialize Session
session_start();

 echo  "<h1>User: " . $_SESSION['login_user'] . "</h1>";

$score = 0;

require_once 'dbLogin.php';

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
} 

if (isset($_POST['snapeKiller'])) {
   $answer1 = $_POST["snapeKiller"];
   $answer2 = $_POST["animal"];
   $answer3 = $_POST["wife"];
   $answer4 = $_POST["kids"];
   $answer5 = $_POST["move"];
   $answer6 = $_POST["gum"];
   $answer7 = $_POST["age"];
   $answer8 = $_POST["teacher"];
   if (strcmp($answer1, "Nagini") == 0) {
      $score++;
   }
   if (strcmp($answer2, "snake") == 0) {
      $score++;
   }
   
   if (strcmp($answer3, "ginny") == 0) {
      $score++;
   }
   
   if (strcmp($answer4, "3") == 0) {
      $score++;
   }
   
   if (strcmp($answer5, "pipes") == 0) {
      $score++;
   }
   
   if (strcmp($answer6, "peeves") == 0) {
      $score++;
   }
   
   if (strcmp($answer7, "115") == 0) {
      $score++;
   }
   
   if (strcmp($answer8, "6") == 0) {
      $score++;
   }
   
   // Add the score to the database (if the user answered at least one question correctly)
   if ($score > 0) {
      $username = $_SESSION['login_user'];
      
      // Create the SQL to insert the current score for the logged in user into the database
      $sql = "INSERT INTO scores (username, score) VALUES ('" . $username . "', " . $score . ");";
      
      // Execute the SQL
      $conn->query($sql);
               
   }
}


// Display the current users' score 
 echo '<h1>Your current score is: ' . $score . '<h1>';
 
 
// Display a table of scores
$sql = "SELECT * FROM scores ORDER BY score DESC";
$result = $conn->query($sql);
 
if ($result->num_rows > 0) {
   echo '
   <table>
      <tr>
         <th>Username</th>
         <th>Score</th>
      </tr>
    ';

    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo "<tr>";
       echo "<td>" . $row["username"]. "</td><td>" . $row["score"]. "</td>";
       echo "</tr>";
    }
    
    echo "</table>";
    
} else {
    echo "No scores yet.";
}


$conn->close();
 
 

?>


<b id="logout"><a href="logout.php">Log Out</a></b>