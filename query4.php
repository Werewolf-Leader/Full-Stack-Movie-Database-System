<?php
// Include database configuration and template functions
require_once 'config.php';
require_once 'template.php';

// Generate page header
generateHeader("Movies by Rating");

// SQL query to find movie titles with max rating, sorted by title
$sql = "SELECT m.Mov_id, m.Mov_Title, m.Mov_Year, m.Mov_Lang, d.Dir_Name, r.Rev_Stars
        FROM MOVIES m
        JOIN DIRECTOR d ON m.Dir_id = d.Dir_id
        JOIN RATING r ON m.Mov_id = r.Mov_id
        ORDER BY r.Rev_Stars DESC, m.Mov_Title";

// Execute the query
$result = $conn->query($sql);

echo '<section>';
echo '<h2>Movies Sorted by Rating (Highest to Lowest)</h2>';

if ($result && $result->num_rows > 0) {
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

    // Also show movies alphabetically sorted
    echo '<h3>Movies Sorted Alphabetically (with Ratings)</h3>';
    
    // SQL query to find movie titles sorted alphabetically
    $sortedQuery = "SELECT m.Mov_id, m.Mov_Title, m.Mov_Year, m.Mov_Lang, d.Dir_Name, r.Rev_Stars
                    FROM MOVIES m
                    JOIN DIRECTOR d ON m.Dir_id = d.Dir_id
                    JOIN RATING r ON m.Mov_id = r.Mov_id
                    ORDER BY m.Mov_Title";
    
    // Execute the query
    $sortedResult = $conn->query($sortedQuery);
    
    if ($sortedResult && $sortedResult->num_rows > 0) {
        // Generate table header
        generateTableHeader($columns);
        
        // Output data of each row
        while ($row = $sortedResult->fetch_assoc()) {
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
    }
} else {
    echo '<p>No movies found.</p>';
}

// Display back link
displayBackLink();
echo '</section>';

// Generate page footer
generateFooter();

// Close database connection
$conn->close();
?> 