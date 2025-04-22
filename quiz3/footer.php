<?php
// footer.php - Displays footer content from database

// Include database connection
include('conn.php');

// Query to get footer content
$query = "SELECT * FROM myFooter LIMIT 1";
$result = $db->query($query);

if ($result->num_rows > 0) {
    $footer = $result->fetch_assoc();
    
    echo '<footer style="background-color: #1e2124; color: white; padding: 20px; text-align: center; margin-top: 50px;">';
    
    // Display copyright text
    if (!empty($footer['copyright_text'])) {
        echo '<p>' . htmlspecialchars($footer['copyright_text']) . '</p>';
    }
    
    // Display contact email if available
    if (!empty($footer['contact_email'])) {
        echo '<p>Contact: <a href="mailto:' . htmlspecialchars($footer['contact_email']) . '" style="color: #a380c2;">' 
             . htmlspecialchars($footer['contact_email']) . '</a></p>';
    }
    
    echo '</footer>';
} else {
    // Fallback footer if no data in table
    echo '<footer style="background-color: #1e2124; color: white; padding: 20px; text-align: center; margin-top: 50px;">';
    echo '<p>© ' . date('Y') . ' My Website. All rights reserved.</p>';
    echo '</footer>';
}

// Close database connection
$db->close();
?>