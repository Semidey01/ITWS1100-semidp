<?php
function buildMenu() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $menu = array(
        'index.php' => 'Home',
        'Lab3/html/about.php' => 'About Me',
        'Lab3/html/work.php' => 'Work',
        'Lab3/html/contact.php' => 'Contact',
    );
    
    $menuOutput = '<div class="top"><ul>';
    
    foreach ($menu as $url => $label) {
        $currentPage = basename($_SERVER['PHP_SELF']);
        $selected = (strpos($currentPage, basename($url)) !== false) ? ' class="selected"' : '';
        $menuOutput .= '<li' . $selected . '><a href="' . $url . '">' . $label . '</a></li>';
    }
    
    if (isset($_SESSION['username'])) {
        // Add admin link if user is admin
        if ($_SESSION['user_role'] === 'admin') {
            $menuOutput .= '<li><a href="admin_labs.php">Manage Labs</a></li>';
        }
        $menuOutput .= '<li><a href="logout.php">Logout (' . htmlspecialchars($_SESSION['username']) . ')</a></li>';
    } else {
        $menuOutput .= '<li><a href="javascript:void(0)" onclick="document.querySelector(\'.login-form\').scrollIntoView()">Login</a></li>';
    }
    
    $menuOutput .= '</ul></div>';
    return $menuOutput;
}
?>