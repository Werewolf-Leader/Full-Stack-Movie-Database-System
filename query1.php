<?php
// Include database configuration and template functions
require_once 'config.php';
require_once 'template.php';

// Generate page header
generateHeader("Movies by Hitchcock");

// SQL query to find all movies directed by Hitchcock
$sql = "SELECT m.Mov_id, m.Mov_Title, m.Mov_Year, m.Mov_Lang, d.Dir_Name
        FROM MOVIES m
        JOIN DIRECTOR d ON m.Dir_id = d.Dir_id
        WHERE d.Dir_Name = 'Hitchcock'
        ORDER BY m.Mov_Year";

// Execute the query
$result = $conn->query($sql);

echo '<section>';
echo '<h2>Movies Directed by Hitchcock</h2>';

if ($result && $result->num_rows > 0) {
    // Generate table header
    $columns = ['Movie ID', 'Title', 'Year', 'Language', 'Director'];
    generateTableHeader($columns);
    
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row["Mov_id"] . '</td>';
        echo '<td>' . $row["Mov_Title"] . '</td>';
        echo '<td>' . $row["Mov_Year"] . '</td>';
        echo '<td>' . $row["Mov_Lang"] . '</td>';
        echo '<td>' . $row["Dir_Name"] . '</td>';
        echo '</tr>';
    }
    
    // Close the table
    generateTableFooter();
} else {
    echo '<p>No movies found directed by Hitchcock.</p>';
}

// Display back link
displayBackLink();
echo '</section>';

// Generate page footer
generateFooter();

// Close database connection
$conn->close();
?> 