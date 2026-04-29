<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}
$course_id = $_GET['course_id'] ?? null;

if (!$course_id) {
    header("Location: dashboard.php");
    exit();
}

$sql = "
SELECT 
    enrollments.id AS enrollment_id,
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard professeur</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<h2>Students</h2>

<table border="1">
<tr>
    <th>Name</th>
    <th>Status</th>
    <th>Action</th>
</tr>
<?php foreach ($students as $s): ?>
<tr>
    <td><?= $s['firstname'] ?> <?= $s['lastname'] ?></td>
    <td><?= $s['status'] ?></td>
    <td>
        <?php if ($s['status'] == 'active'): ?>
            <a href="update_status.php?id=<?= $s['id'] ?>&status=completed">
                Mark Completed
            </a>
        <?php else: ?>
            <a href="update_status.php?id=<?= $s['id'] ?>&status=active">
                Reactivate
            </a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>

</table>


</body>

</html>