<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Lab3/css/top.css">
        <link rel="stylesheet" href="../Lab3/css/labs.css"> <!-- Reusing labs.css -->
        <link rel="stylesheet" href="resources/footer.css">
        <title>Pablo Semidey Website - Projects</title>
    </head>
    <body>
        <?php 
        // Include database connection and menu functions
        include('conn.php');
        include('menu2.php');
        
        // Display the navigation menu
        echo buildMenu();
        ?>

        <div class="labs">
            <h1>Projects</h1>
            <hr>
            
            <div class="list">
                <?php
                // Query to get all projects from database
                $query = "SELECT * FROM myProjects ORDER BY project_id";
                $result = $db->query($query);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="dropdown">';
                        echo '<h1>' . htmlspecialchars($row['project_name']) . '</h1>';
                        
                        echo '<div class="dropdown-content">';
                        // Project page button
                        if (!empty($row['project_page'])) {
                            echo '<a href="' . htmlspecialchars($row['project_page']) . '" class="button" target="_blank">View Project</a>';
                        }
                        
                        echo '</div>'; // close dropdown-content
                        echo '</div>'; // close dropdown
                    }
                } else {
                    echo '<p style="color: white;">No projects found in database.</p>';
                }
                
                // Close database connection
                $db->close();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="../../lab8/menu.js"></script>

        <?php include('footer.php'); ?>
    </body>
</html>