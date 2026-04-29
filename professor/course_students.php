<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}

$course_id = $_GET['course_id'];

$sql = "
SELECT 
    enrollments.id,
    users.firstname,
    users.lastname,
    enrollments.status
FROM enrollments
JOIN students ON students.id = enrollments.student_id
JOIN users ON users.id = students.user_id
WHERE enrollments.course_id = :course_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['course_id' => $course_id]);

$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>