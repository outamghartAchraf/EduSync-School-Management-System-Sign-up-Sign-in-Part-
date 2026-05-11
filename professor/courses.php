<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("location: ../auth/login.php");
    exit;
}

$coure = $_SESSION['user']['id'];

$stmt = $pdo->prepare("
SELECT 
c.id, c.title, c.description, c.total_hours
FROM courses c
left join enrollments e ON e.course_id =c.id 
where e.student_id IS NULL ;");
$stmt ->execute(['$coure'];);



