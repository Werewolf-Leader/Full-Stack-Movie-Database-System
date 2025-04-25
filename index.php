<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Database</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Movie Database System</h1>
        </header>

        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>

        <main>
            <section class="welcome">
                <h2>Welcome to the Movie Database System</h2>
                
                <div class="features">
                    <div class="feature-card">
                        <h3>Movies by Hitchcock</h3>
                        <p>Shows all movies directed by Hitchcock</p>
                        <a href="query1.php" class="button">View</a>
                    </div>

                    <div class="feature-card">
                        <h3>Actors in Multiple Movies</h3>
                        <p>Shows actors who have worked in 2 or more movies</p>
                        <a href="query2.php" class="button">View</a>
                    </div>

                    <div class="feature-card">
                        <h3>Actors Across Eras</h3>
                        <p>Shows actors who acted before 2000 and after 2015</p>
                        <a href="query3.php" class="button">View</a>
                    </div>

                    <div class="feature-card">
                        <h3>Movies by Rating</h3>
                        <p>Shows movie titles with maximum rating per movie, sorted by title</p>
                        <a href="query4.php" class="button">View</a>
                    </div>

                    <div class="feature-card">
                        <h3>Update Spielberg Ratings</h3>
                        <p>Updates ratings of all movies by Steven Spielberg to 5</p>
                        <a href="query5.php" class="button">Update</a>
                    </div>
                </div>
            </section>
        </main>

        <footer>
                <p>&copy; 2025 Movie Database System </p>
                <p>DBMS SKILL BASED PROJECT </p>
                <p>Created by: Mukul Sharma(0901AI231038) - IT(AI and Robotics)</p>
        </footer>
    </div>
</body>
</html> 