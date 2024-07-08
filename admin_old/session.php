<?php
include '../database.php';
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
