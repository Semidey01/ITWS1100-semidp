<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/top.css">
        <link rel="stylesheet" href="../css/labs.css">
        <title>Pablo Semidey Website - Labs</title>
    </head>
    <body>
        <?php 
        // Include database connection and menu functions
        include('conn.php');
        include('menu.php');
        
        // Display the navigation menu
        echo buildMenu();
        ?>

        <div class="labs">
            <h1>Labs</h1>
            <hr>
            
            <div class="list">
                <?php
                // Query to get all labs from database
                $query = "SELECT * FROM myLabs ORDER BY lab_id";
                $result = $db->query($query);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="dropdown">';
                        echo '<h1>' . htmlspecialchars($row['lab_name']) . '</h1>';
                        
                        echo '<div class="dropdown-content">';
                        // Readme button
                        if (!empty($row['lab_readme'])) {
                            echo '<a href="' . htmlspecialchars($row['lab_readme']) . '" class="button" target="_blank">README</a>';
                        }
                        
                        // Lab page button
                        if (!empty($row['lab_page'])) {
                            echo '<a href="' . htmlspecialchars($row['lab_page']) . '" class="button" target="_blank">View Lab</a>';
                        }
                        
                        echo '</div>'; // close dropdown-content
                        echo '</div>'; // close dropdown
                    }
                } else {
                    echo '<p style="color: white;">No labs found in database.</p>';
                }
                
                // Close database connection
                $db->close();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../lab8/menu.js"></script>
    </body>
</html>