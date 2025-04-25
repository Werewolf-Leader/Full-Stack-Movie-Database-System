<?php
// Simple database setup utility
$servername = "localhost";
$username = isset($_POST['username']) ? $_POST['username'] : "root";
$password = isset($_POST['password']) ? $_POST['password'] : "";

if (isset($_POST['setup'])) {
    // Create connection
    $conn = new mysqli($servername, $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        $error = "Connection failed: " . $conn->connect_error;
    } else {
        // Read database.sql file
        $sql = file_get_contents('database.sql');
        
        // Execute multi query
        if ($conn->multi_query($sql)) {
            $success = "Database setup completed successfully!";
            
            // Update config.php with the correct credentials
            $config_content = file_get_contents('config.php');
            $config_content = preg_replace('/\$username = ".*?";/', '$username = "' . $username . '";', $config_content);
            $config_content = preg_replace('/\$password = ".*?";/', '$password = "' . $password . '";', $config_content);
            file_put_contents('config.php', $config_content);
        } else {
            $error = "Error setting up database: " . $conn->error;
        }
        
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Database - Installation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .install-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Movie Database System - Installation</h1>
        </header>
        
        <main>
            <div class="install-container">
                <h2>Database Setup</h2>
                
                <?php if (isset($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if (isset($success)): ?>
                    <div class="success-message">
                        <?php echo $success; ?>
                        <p>You can now <a href="index.php" class="button">Go to the application</a></p>
                    </div>
                <?php else: ?>
                    <p>This utility will help you set up the Movie Database.</p>
                    
                    <form method="post" action="install.php">
                        <div>
                            <label for="username">MySQL Username:</label>
                            <input type="text" id="username" name="username" value="root">
                            <small style="display: block; margin-top: 5px; color: #666;">On Ubuntu, this is usually "root"</small>
                        </div>
                        
                        <div>
                            <label for="password">MySQL Password:</label>
                            <input type="password" id="password" name="password" value="">
                            <small style="display: block; margin-top: 5px; color: #666;">On Ubuntu, the MySQL root user often uses password authentication with sudo. Try entering your system user password.</small>
                        </div>
                        
                        <button type="submit" name="setup" class="button">Setup Database</button>
                    </form>
                    
                    <p><strong>Note:</strong> If you're having issues connecting, you may need to:</p>
                    <ol>
                        <li>Use a different MySQL user if one was created during installation</li>
                        <li>Or create a new MySQL user with appropriate permissions using:<br>
                            <code>sudo mysql -e "CREATE USER 'dbuser'@'localhost' IDENTIFIED BY 'password'; GRANT ALL PRIVILEGES ON movie_db.* TO 'dbuser'@'localhost'; FLUSH PRIVILEGES;"</code>
                        </li>
                    </ol>
                <?php endif; ?>
            </div>
        </main>
        
        <footer>
            <p>&copy; 2023 Movie Database System</p>
        </footer>
    </div>
</body>
</html> 