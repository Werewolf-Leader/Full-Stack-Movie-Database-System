<?php
// Include database configuration and template functions
require_once 'config.php';
require_once 'template.php';

// Generate page header
generateHeader("Actors Across Eras");

// SQL query to find actors who acted before 2000 and after 2015
$sql = "SELECT DISTINCT a.Act_id, a.Act_Name, a.Act_Gender
        FROM ACTOR a
        JOIN MOVIE_CAST mc ON a.Act_id = mc.Act_id
        JOIN MOVIES m ON mc.Mov_id = m.Mov_id
        WHERE a.Act_id IN (
            SELECT mc1.Act_id
            FROM MOVIE_CAST mc1
            JOIN MOVIES m1 ON mc1.Mov_id = m1.Mov_id
            WHERE m1.Mov_Year < 2000
        )
        AND a.Act_id IN (
            SELECT mc2.Act_id
            FROM MOVIE_CAST mc2
            JOIN MOVIES m2 ON mc2.Mov_id = m2.Mov_id
            WHERE m2.Mov_Year > 2015
        )
        ORDER BY a.Act_Name";

// Execute the query
$result = $conn->query($sql);

echo '<section>';
echo '<h2>Actors Who Acted Before 2000 and After 2015</h2>';

if ($result && $result->num_rows > 0) {
    // Generate table header
    $columns = ['Actor ID', 'Actor Name', 'Gender'];
    generateTableHeader($columns);
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["Act_id"] . '</td>';
        echo '<td>' . $row["Act_Name"] . '</td>';
        echo '<td>' . $row["Act_Gender"] . '</td>';
        echo '</tr>';
    }
    
    // Close the table
    generateTableFooter();
    
    // Display the movies for these actors, showing their work across eras
    echo '<h3>Movies by These Actors Across Eras</h3>';
    
    $actorMoviesQuery = "
        SELECT a.Act_id, a.Act_Name, m.Mov_id, m.Mov_Title, m.Mov_Year, mc.Role
        FROM ACTOR a
        JOIN MOVIE_CAST mc ON a.Act_id = mc.Act_id
        JOIN MOVIES m ON mc.Mov_id = m.Mov_id
        WHERE a.Act_id IN (
            SELECT DISTINCT a2.Act_id
            FROM ACTOR a2
            JOIN MOVIE_CAST mc2 ON a2.Act_id = mc2.Act_id
            JOIN MOVIES m2 ON mc2.Mov_id = m2.Mov_id
            WHERE a2.Act_id IN (
                SELECT mc3.Act_id
                FROM MOVIE_CAST mc3
                JOIN MOVIES m3 ON mc3.Mov_id = m3.Mov_id
                WHERE m3.Mov_Year < 2000
            )
            AND a2.Act_id IN (
                SELECT mc4.Act_id
                FROM MOVIE_CAST mc4
                JOIN MOVIES m4 ON mc4.Mov_id = m4.Mov_id
                WHERE m4.Mov_Year > 2015
            )
        )
        ORDER BY a.Act_Name, m.Mov_Year
    ";
    
    $moviesResult = $conn->query($actorMoviesQuery);
    
    if ($moviesResult && $moviesResult->num_rows > 0) {
        // Generate table header for movies
        $movieColumns = ['Actor ID', 'Actor Name', 'Movie ID', 'Movie Title', 'Year', 'Role'];
        generateTableHeader($movieColumns);
        
        // Output data of each row
        while ($row = $moviesResult->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["Act_id"] . '</td>';
            echo '<td>' . $row["Act_Name"] . '</td>';
            echo '<td>' . $row["Mov_id"] . '</td>';
            echo '<td>' . $row["Mov_Title"] . '</td>';
            echo '<td>' . $row["Mov_Year"] . '</td>';
            echo '<td>' . $row["Role"] . '</td>';
            echo '</tr>';
        }
        
        // Close the table
        generateTableFooter();
    }
} else {
    echo '<p>No actors found who acted both before 2000 and after 2015.</p>';
}

// Display back link
displayBackLink();
echo '</section>';

// Generate page footer
generateFooter();

// Close database connection
$conn->close();
?> 