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

<div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-6">

<h2 class="text-2xl font-bold text-gray-700 mb-6">Students</h2>

<div class="overflow-x-auto">

<table class="w-full border-collapse">

<tr class="bg-gray-200 text-left">
    <th class="p-3">Name</th>
    <th class="p-3">Status</th>
    <th class="p-3 text-center">Action</th>
</tr>

<?php foreach ($students as $s): ?>
<tr class="border-b hover:bg-gray-50 transition">

<td class="p-3 font-medium text-gray-700">
<?= $s['firstname'] ?> <?= $s['lastname'] ?>
</td>

<td class="p-3">
<?= $s['status'] ?>
</td>

<td class="p-3 text-center">

<?php if ($s['status'] == 'active'): ?>

<a href="update_status.php?id=<?= $s['enrollment_id'] ?>&status=completed"
   class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
   Marquer terminé
</a>

<?php else: ?>

<a href="update_status.php?id=<?= $s['enrollment_id'] ?>&status=active"
   class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
   Reactivate
</a>

<?php endif; ?>

</td>

</tr>
<?php endforeach; ?>

</table>

</div>
</div>

</body>

</html>