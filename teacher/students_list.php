<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'prof') {
    header("Location: ../auth/login.php");
    exit;
}
$course_id = $_GET['course_id'] ?? null;
if (! $course_id){ header("Location: mycourses.php"); 
exit;
}
$stmt = $conn->prepare($query);
$stmt->execute([$course_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>