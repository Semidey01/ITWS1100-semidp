<?php
// footer.php - Displays footer content from database


include('conn.php');

// Query to get footer content
$query = "SELECT * FROM myFooter LIMIT 1";
$result = $db->query($query);

echo '<footer>';

if ($result->num_rows > 0) {
    $footer = $result->fetch_assoc();
    
    // Display copyright text
    if (!empty($footer['copyright_text'])) {
        echo '<p>' . htmlspecialchars($footer['copyright_text']) . '</p>';
    }
    
    // Display contact email if available
    if (!empty($footer['contact_email'])) {
        echo '<p>Contact: <a href="mailto:' . htmlspecialchars($footer['contact_email']) . '">' 
             . htmlspecialchars($footer['contact_email']) . '</a></p>';
    }
} else {
    // Fallback footer if no data in table
    echo '<p>© ' . date('Y') . ' My Website. All rights reserved.</p>';
}

echo '</footer>';

// Close database connection
$db->close();
?>