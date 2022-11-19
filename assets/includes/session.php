<?php
	// include 'config/database.php';
	session_start();

if (!(isset($_SESSION['id']))) {
	header('location:Signin');
}

$student_id = $_SESSION['id'];