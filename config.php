<?php
// Database connection parameters
$servername = "localhost";
$username = "moviedb";  // New MySQL user 
$password = "Movie_DB_Pass123";  // New MySQL password
$dbname = "movie_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // If connection fails, display error but don't die
    echo "<div style='color: red; padding: 20px; background-color: #ffeeee; border: 1px solid #ffaaaa; margin: 20px;'>
    <h3>Database Connection Error</h3>
    <p>Connection failed: " . $conn->connect_error . "</p>
    <p>Please make sure:</p>
    <ol>
        <li>MySQL is running on your system</li>
        <li>The database 'movie_db' has been created</li>
        <li>The username and password in config.php are correct</li>
    </ol>
    <p>You can continue browsing the UI, but database functionality will not work.</p>
    </div>";
}
?> 