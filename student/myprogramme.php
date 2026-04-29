<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id = $_SESSION['user']['id'];

// SQL US25 : cours + professeur
$sql = $pdo->prepare("
    SELECT 
        c.title,
        c.description,
        c.total_hours,
        u.firstname,
        u.lastname
    FROM users stu
    INNER JOIN students s ON stu.id = s.user_id
    INNER JOIN enrollments e ON e.student_id = s.id
    INNER JOIN courses c ON c.id = e.course_id
    INNER JOIN users u ON u.id = c.prof_id
    WHERE stu.id = ?
");

$sql->execute([$id]);
$courses = $sql->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Program</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">

<div class="max-w-5xl mx-auto">

    <!-- Card -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <!-- Header -->
        <div class="p-4 border-b">
            <h2 class="text-lg font-bold">📚 Mon Programme</h2>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">

                <!-- Head -->
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Course Name</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Instructor</th>
                        <th class="px-4 py-3">Hours</th>
                     
                    </tr>
                </thead>

                <!-- Body -->
                <tbody class="divide-y">

                <?php if (!empty($courses)): ?>

                    <?php foreach ($courses as $course): ?>

                        

                        <tr class="hover:bg-gray-50">

                            <!-- Title -->
                            <td class="px-4 py-3 font-semibold text-indigo-600">
                                <?= htmlspecialchars($course->title) ?>
                            </td>

                            <!-- Description -->
                            <td class="px-4 py-3 text-gray-600">
                                <?= htmlspecialchars($course->description ?? 'No description') ?>
                            </td>

                            <!-- Instructor -->
                            <td class="px-4 py-3">
                                <?= htmlspecialchars($course->firstname . " " . $course->lastname) ?>
                            </td>

                            <!-- Hours -->
                            <td class="px-4 py-3 font-semibold">
                                <?= htmlspecialchars($course->total_hours) ?>h
                            </td>

                          

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="text-center p-6 text-red-500 font-semibold">
                            Aucun cours trouvé
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>
        </div>

    </div>

</div>

</body>
</html>