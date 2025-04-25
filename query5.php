<?php
// Include database configuration and template functions
require_once 'config.php';
require_once 'template.php';

// Generate page header
generateHeader("Update Spielberg Movies");

echo '<section>';
echo '<h2>Update Ratings of Movies by Steven Spielberg</h2>';

// Check if the form has been submitted
if (isset($_POST['update'])) {
    // SQL query to update ratings of movies by Steven Spielberg to 5
    $updateSql = "UPDATE RATING r
                  JOIN MOVIES m ON r.Mov_id = m.Mov_id
                  JOIN DIRECTOR d ON m.Dir_id = d.Dir_id
                  SET r.Rev_Stars = 5.0
                  WHERE d.Dir_Name = 'Steven Spielberg'";
    
    // Execute the update query
    if ($conn->query($updateSql) === TRUE) {
        displaySuccess("Successfully updated ratings of all Steven Spielberg movies to 5.0");
    } else {
        displayError("Error updating ratings: " . $conn->error);
    }
}

// Display current ratings before/after update
// SQL query to get Spielberg movies with their ratings
$sql = "SELECT m.Mov_id, m.Mov_Title, m.Mov_Year, m.Mov_Lang, d.Dir_Name, r.Rev_Stars
        FROM MOVIES m
        JOIN DIRECTOR d ON m.Dir_id = d.Dir_id
        JOIN RATING r ON m.Mov_id = r.Mov_id
        WHERE d.Dir_Name = 'Steven Spielberg'
        ORDER BY m.Mov_Year";

// Execute the query
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo '<h3>Steven Spielberg Movies and Their Ratings</h3>';
    
    // Generate table header
    $columns = ['Movie ID', 'Title', 'Year', 'Language', 'Director', 'Rating'];
    generateTableHeader($columns);
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["Mov_id"] . '</td>';
        echo '<td>' . $row["Mov_Title"] . '</td>';
        echo '<td>' . $row["Mov_Year"] . '</td>';
        echo '<td>' . $row["Mov_Lang"] . '</td>';
        echo '<td>' . $row["Dir_Name"] . '</td>';
        echo '<td>' . $row["Rev_Stars"] . '</td>';
        echo '</tr>';
    }
    
    // Close the table
    generateTableFooter();
    
    // Add a form to allow updating the ratings
    echo '<div class="query-form">
        <form method="post" action="query5.php">
            <p>Click the button below to update all Steven Spielberg movie ratings to 5.0</p>
            <button type="submit" name="update" class="button">Update Ratings</button>
        </form>
    </div>';
} else {
    echo '<p>No movies found directed by Steven Spielberg.</p>';
}

// Display back link
displayBackLink();
echo '</section>';

// Generate page footer
generateFooter();

// Close database connection
$conn->close();
?> 