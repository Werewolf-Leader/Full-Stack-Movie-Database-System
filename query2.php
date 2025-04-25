<?php
// Include database configuration and template functions
require_once 'config.php';
require_once 'template.php';

// Generate page header
generateHeader("Actors in Multiple Movies");

// SQL query to find actors who worked in 2 or more movies
$sql = "SELECT a.Act_id, a.Act_Name, a.Act_Gender, COUNT(mc.Mov_id) AS movie_count
        FROM ACTOR a
        JOIN MOVIE_CAST mc ON a.Act_id = mc.Act_id
        GROUP BY a.Act_id, a.Act_Name, a.Act_Gender
        HAVING COUNT(mc.Mov_id) >= 2
        ORDER BY movie_count DESC, a.Act_Name";

// Execute the query
$result = $conn->query($sql);

echo '<section>';
echo '<h2>Actors Who Worked in 2 or More Movies</h2>';

if ($result && $result->num_rows > 0) {
    // Generate table header
    $columns = ['Actor ID', 'Actor Name', 'Gender', 'Movie Count'];
    generateTableHeader($columns);
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["Act_id"] . '</td>';
        echo '<td>' . $row["Act_Name"] . '</td>';
        echo '<td>' . $row["Act_Gender"] . '</td>';
        echo '<td>' . $row["movie_count"] . '</td>';
        echo '</tr>';
    }
    
    // Close the table
    generateTableFooter();

    // Now display the actual movies for these actors
    echo '<h3>Movies by Actors Who Appeared in 2+ Films</h3>';
    
    $moviesQuery = "
        SELECT a.Act_id, a.Act_Name, m.Mov_id, m.Mov_Title, m.Mov_Year, mc.Role
        FROM ACTOR a
        JOIN MOVIE_CAST mc ON a.Act_id = mc.Act_id
        JOIN MOVIES m ON mc.Mov_id = m.Mov_id
        WHERE a.Act_id IN (
            SELECT a2.Act_id
            FROM ACTOR a2
            JOIN MOVIE_CAST mc2 ON a2.Act_id = mc2.Act_id
            GROUP BY a2.Act_id
            HAVING COUNT(mc2.Mov_id) >= 2
        )
        ORDER BY a.Act_Name, m.Mov_Year
    ";
    
    $moviesResult = $conn->query($moviesQuery);
    
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
    echo '<p>No actors found who worked in 2 or more movies.</p>';
}

// Display back link
displayBackLink();
echo '</section>';

// Generate page footer
generateFooter();

// Close database connection
$conn->close();
?> 