<?php
function buildMenu() {
    session_start();
    
    // create an array of menu items with their URLs and labels
    $menu = array(
        'index.php' => 'Home',
        'Lab3/html/about.php' => 'About Me',  // Changed to .php
        'Lab3/html/work.php' => 'Work',       // Changed to .php
        'Lab3/html/contact.php' => 'Contact', // Changed to .php
    );
    
    // construct the menu
    $menuOutput = '<div class="top"><ul>';
    
    foreach ($menu as $url => $label) {
        $currentPage = basename($_SERVER['PHP_SELF']);
        $selected = (strpos($currentPage, basename($url)) !== false) ? ' class="selected"' : '';
        
        $menuOutput .= '<li' . $selected . '><a href="' . $url . '">' . $label . '</a></li>';
    }
    
    // Add login/logout menu item
    if (isset($_SESSION['username'])) {
        $menuOutput .= '<li><a href="logout.php">Logout (' . htmlspecialchars($_SESSION['username']) . ')</a></li>';
        
        // Add admin menu item if user is admin
        if ($_SESSION['user_role'] === 'admin') {
            $menuOutput .= '<li><a href="admin.php">Admin</a></li>';
        }
    } else {
        $menuOutput .= '<li><a href="quiz3/login.php">Login</a></li>';
    }
    
    $menuOutput .= '</ul></div>';
    return $menuOutput;
}
?>