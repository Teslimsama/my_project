<?php
include '../database.php';
include '../alert.message.php';
session_start();

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {
	header('location: ../index');
	exit();
}

$conn = $pdo->open();

$stmt = $conn->prepare("SELECT * FROM unibooker WHERE id=:id");
$stmt->execute(['id' => $_SESSION['admin']]);
$admin = $stmt->fetch();

$pdo->close();
// Generate the placeholder URL
$placeholder_url = "https://placehold.co/600x400?text=" . urlencode($first_name . " " . $last_name);
