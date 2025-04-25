<?php

function generateHeader($pageTitle) {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $pageTitle . ' - Movie Database</title>
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
            
            <main>';
}


function generateFooter() {
    echo '
            </main>
            <footer>
                <p>&copy; 2025 Movie Database System </p>
                <p>DBMS SKILL BASED PROJECT </p>
                <p>- Created by: Mukul Sharma(0901AI231038) - IT(AI and Robotics)</p>
            </footer>
        </div>
    </body>
    </html>';
}


function generateTableHeader($columns) {
    echo '<table class="result-table">
        <thead>
            <tr>';
    
    foreach ($columns as $column) {
        echo '<th>' . $column . '</th>';
    }
    
    echo '</tr>
        </thead>
        <tbody>';
}


function generateTableFooter() {
    echo '</tbody>
    </table>';
}


function displaySuccess($message) {
    echo '<div class="success-message">' . $message . '</div>';
}


function displayError($message) {
    echo '<div class="error-message">' . $message . '</div>';
}


function displayBackLink() {
    echo '<a href="index.php" class="back-link">← Back to Home</a>';
}
?> 