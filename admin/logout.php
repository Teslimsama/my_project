<?php
// Initialize the session
nclude "assets/includes/session.php";
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: Signin");
exit;
?>