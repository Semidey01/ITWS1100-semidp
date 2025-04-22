<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../Lab3/css/top.css">
        <link rel="stylesheet" href="../Lab3/css/labs.css">
        <link rel="stylesheet" href="resources/footer.css">
        <title>Pablo Semidey Website - Labs</title>
        <style>
            .admin-form {
                background-color: rgba(30, 33, 36, 0.9);
                padding: 20px;
                border-radius: 8px;
                margin-bottom: 30px;
                max-width: 800px;
                margin-left: auto;
                margin-right: auto;
            }
            .admin-form h2 {
                color: aliceblue;
                text-align: center;
                margin-bottom: 20px;
            }
            .admin-form label {
                display: block;
                color: white;
                margin-bottom: 5px;
            }
            .admin-form input, .admin-form textarea {
                width: 100%;
                padding: 8px;
                margin-bottom: 15px;
                border-radius: 4px;
                border: 1px solid #444;
                background-color: #2a2e32;
                color: white;
            }
            .admin-form button {
                background-color: #4f8fc5;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .delete-btn {
                background-color: #ff6b6b;
                color: white;
                padding: 5px 10px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-left: 15px;
            }
            .delete-btn:hover {
                background-color: #ff5252;
            }
        </style>
    </head>
    <body>
        <?php 
        session_start();
        include('conn.php');
        include('menu2.php');
        
        // Handle form submission for adding labs
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_lab'])) {
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                $lab_name = $db->real_escape_string($_POST['lab_name']);
                $lab_readme = $db->real_escape_string($_POST['lab_readme']);
                $lab_page = $db->real_escape_string($_POST['lab_page']);
                
                $query = "INSERT INTO myLabs (lab_name, lab_readme, lab_page) VALUES ('$lab_name', '$lab_readme', '$lab_page')";
                $db->query($query);
                header("Location: labs.php");
                exit();
            }
        }
        
        // Handle lab deletion
        if (isset($_GET['delete'])) {
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                $lab_id = (int)$_GET['delete'];
                $query = "DELETE FROM myLabs WHERE lab_id = $lab_id";
                $db->query($query);
                header("Location: labs.php");
                exit();
            }
        }
        
        echo buildMenu();
        ?>

        <div class="labs">
            <h1>Labs</h1>
            <hr>
            
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                <div class="admin-form">
                    <h2>Add New Lab</h2>
                    <form method="POST">
                        <label for="lab_name">Lab Name:</label>
                        <input type="text" id="lab_name" name="lab_name" required>
                        
                        <label for="lab_readme">README URL:</label>
                        <input type="text" id="lab_readme" name="lab_readme" required>
                        
                        <label for="lab_page">Lab Page URL:</label>
                        <input type="text" id="lab_page" name="lab_page" required>
                        
                        <button type="submit" name="add_lab">Add Lab</button>
                    </form>
                </div>
            <?php endif; ?>
            
            <div class="list">
                <?php
                $query = "SELECT * FROM myLabs ORDER BY lab_id";
                $result = $db->query($query);
                
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div class="dropdown">';
                        echo '<div style="display: flex; align-items: center;">';
                        echo '<h1 style="margin: 0;">' . htmlspecialchars($row['lab_name']) . '</h1>';
                        
                        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
                            echo '<button class="delete-btn" onclick="if(confirm(\'Are you sure?\')) window.location.href=\'labs.php?delete=' . $row['lab_id'] . '\'">Delete</button>';
                        }
                        
                        echo '</div>';
                        
                        echo '<div class="dropdown-content">';
                        if (!empty($row['lab_readme'])) {
                            echo '<a href="' . htmlspecialchars($row['lab_readme']) . '" class="button" target="_blank">README</a>';
                        }
                        if (!empty($row['lab_page'])) {
                            echo '<a href="' . htmlspecialchars($row['lab_page']) . '" class="button" target="_blank">View Lab</a>';
                        }
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="color: white;">No labs found in database.</p>';
                }
                
                $db->close();
                ?>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <?php include('footer.php'); ?>
    </body>
</html>