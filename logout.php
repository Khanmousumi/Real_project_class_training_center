
<?php
session_start();

// Remove session data
$_SESSION = array();

// Destroy session
session_destroy();

// Redirect to login
header("Location: ../login/login.php");
exit;

