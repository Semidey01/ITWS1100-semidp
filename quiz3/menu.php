<?php

function buildMenu() {
  // create an array of menu items with their URLs and labels
  $menu = array(
    'index.php' => 'Home',
    'Lab3/html/about.php' => 'About Me',
    'Lab3/html/work.php' => 'Work',
    'Lab3/html/contact.php' => 'Contact'
  );
  
  // construct the menu
  $menuOutput = '<div class="top"><ul>';
  
  foreach ($menu as $url => $label) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    $selected = (strpos($currentPage, basename($url)) !== false) ? ' class="selected"' : '';
    
    $menuOutput .= '<li' . $selected . '><a href="' . $url . '">' . $label . '</a></li>';
  }
  
  $menuOutput .= '</ul></div>';
  return $menuOutput;
}

?>