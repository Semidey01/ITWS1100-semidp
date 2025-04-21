<?php

// Database connection parameters
$dbServer = 'localhost';
$dbUser = 'phpmyadmin';
$dbPassword = 'Antonio00!1074';
$dbName = 'mySite';

// Create connection
$db = new mysqli($dbServer, $dbUser, $dbPassword, $dbName);

// Check connection
if ($db->connect_error) {
    die('<div class="messages">Could not connect to the database. Error: ' . 
        $db->connect_errno . ' - ' . $db->connect_error . '</div>');
}