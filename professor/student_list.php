<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("location: ../auth/login.php");
    exit;
}

$teacher_id = $_SESSION['user']['id'];

try {

 
    $query = "
        SELECT 
            c.title,
            u.firstname,
            u.lastname,
            u.email,
            s.student_number,
            e.status
        FROM enrollments e
        JOIN students s ON e.student_id = s.id
        JOIN users u ON s.user_id = u.id
        JOIN courses c ON e.course_id = c.id
        WHERE c.prof_id = ?
        ORDER BY c.title
    ";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$teacher_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>US21 - Students List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 p-8">

<div class="max-w-6xl mx-auto">

    <h1 class="text-3xl font-bold mb-6 text-gray-800">
         Students of My Courses
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="w-full text-left">
            <thead class="bg-gray-900 text-white">
                <tr>
                    <th class="p-4">Course</th>
                    <th class="p-4">Full Name</th>
                    <th class="p-4">Student Number</th>
                    <th class="p-4">Email</th>
                    <th class="p-4 text-center">Status</th>
                </tr>
            </thead>

            <tbody>

            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $r): ?>
                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-4 font-semibold text-gray-700">
                            <?= htmlspecialchars($r['title']) ?>
                        </td>

                        <td class="p-4">
                            <?= htmlspecialchars($r['firstname'] . ' ' . $r['lastname']) ?>
                        </td>

                        <td class="p-4 text-gray-600">
                            <?= htmlspecialchars($r['student_number']) ?>
                        </td>

                        <td class="p-4 text-blue-600">
                            <?= htmlspecialchars($r['email']) ?>
                        </td>

                        <td class="p-4 text-center">
                            <span class="px-3 py-1 text-xs font-bold rounded-full
                                <?= $r['status'] === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-blue-100 text-blue-700' ?>">
                                <?= ucfirst($r['status']) ?>
                            </span>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="p-10 text-center text-gray-400 italic">
                        No students found for your courses
                    </td>
                </tr>
            <?php endif; ?>

            </tbody>
        </table>

    </div>
</div>

</body>
</html>