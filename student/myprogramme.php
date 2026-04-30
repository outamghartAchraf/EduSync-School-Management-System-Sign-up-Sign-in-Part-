<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id = $_SESSION['user']['id'];

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

<body class="bg-gray-100">

<div class="flex">

    
    <aside class="w-64 bg-blue-600 text-white min-h-screen fixed shadow-lg">

        <div class="px-5 py-4 text-xl font-bold">
            EduSync
        </div>

        <hr class="border-blue-400">

        <nav class="mt-4 flex flex-col gap-1 px-3">

            <a href="dashboard.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                Dashboard
            </a>

            <!-- ACTIVE -->
            <a href="myprogramme.php" class="px-4 py-2 rounded-md bg-blue-500 font-semibold">
                Mon Programme
            </a>

            <a href="mapromotion.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                Promotion
            </a>

            <a href="profile.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                 Profile
            </a>

            <a href="details.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                Details
            </a>

        </nav>

        <div class="absolute bottom-0 w-full px-5 py-4 border-t border-blue-400">
            <a href="../auth/logout.php" class="text-yellow-300 hover:text-yellow-400">
                 Logout
            </a>
        </div>

    </aside>


   
    <main class="ml-64 w-full p-6">

        <div class="max-w-5xl mx-auto">

         
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

           
                <div class="p-4 border-b">
                    <h2 class="text-lg font-bold">📚 Mon Programme</h2>
                </div>

              
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">

                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-3">Course Name</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Instructor</th>
                                <th class="px-4 py-3">Hours</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                        <?php if (!empty($courses)): ?>

                            <?php foreach ($courses as $course): ?>

                            <tr class="hover:bg-gray-50">

                                <td class="px-4 py-3 font-semibold text-indigo-600">
                                    <?= htmlspecialchars($course->title) ?>
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    <?= htmlspecialchars($course->description ?? 'No description') ?>
                                </td>

                                <td class="px-4 py-3">
                                    <?= htmlspecialchars($course->firstname . " " . $course->lastname) ?>
                                </td>

                                <td class="px-4 py-3 font-semibold">
                                    <?= htmlspecialchars($course->total_hours) ?>h
                                </td>

                            </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="4" class="text-center p-6 text-red-500 font-semibold">
                                    Aucun cours trouvé
                                </td>
                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>