<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id = $_SESSION['user']['id'];

$sqlState = $pdo->prepare("
    SELECT 
        c.title,
        c.description,
        c.total_hours
    FROM users u
    INNER JOIN students s ON u.id = s.user_id
    INNER JOIN enrollments e ON e.student_id = s.id
    INNER JOIN courses c ON c.id = e.course_id
    WHERE u.id = ?
");

$sqlState->execute([$id]);
$courses = $sqlState->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Mes matires</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

   
    <aside class="w-64 bg-blue-600 text-white min-h-screen fixed shadow-lg flex flex-col">

     
        <div class="px-6 py-5 text-2xl font-bold border-b border-blue-400">
             EduSync
        </div>

   
        <nav class="flex flex-col mt-4 px-3 space-y-1">

            <a href="dashboard.php"
               class="px-4 py-2 rounded-lg hover:bg-blue-500 transition">
                 Dashboard
            </a>

            <a href="myprogramme.php"
               class="px-4 py-2 rounded-lg bg-blue-500 font-semibold">
                 Mes matières
            </a>

            <a href="mapromotion.php"
               class="px-4 py-2 rounded-lg hover:bg-blue-500 transition">
                 Camarades
            </a>

            <a href="profile.php"
               class="px-4 py-2 rounded-lg hover:bg-blue-500 transition">
                 Profile
            </a>

            <a href="details.php"
               class="px-4 py-2 rounded-lg hover:bg-blue-500 transition">
                Details
            </a>

        </nav>

       
        <div class="mt-auto px-6 py-4 border-t border-blue-400">
            <a href="../auth/logout.php"
               class="text-yellow-300 hover:text-yellow-400 flex items-center gap-2">
                 Logout
            </a>
        </div>

    </aside>


   
    <main class="ml-64 w-full p-6">

        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">📚 Mes matieres</h1>
            </div>

          
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <?php if (!empty($courses)): ?>

                    <?php foreach($courses as $course): ?>

                    <div class="bg-white p-5 rounded-2xl shadow hover:shadow-xl transition">

                        <h2 class="text-xl font-bold text-indigo-600 mb-2">
                            <?= htmlspecialchars($course->title) ?>
                        </h2>

                        <p class="text-gray-600 text-sm">
                            <?= htmlspecialchars($course->description ?? 'Pas de description') ?>
                        </p>

                        <div class="mt-4 text-sm font-semibold text-gray-700">
                             <?= htmlspecialchars($course->total_hours ?? '0') ?> heures
                        </div>

                    </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="col-span-3 text-center mt-10">
                        <p class="text-red-500 font-semibold text-lg">
                            Aucun cours trouve
                        </p>
                    </div>

                <?php endif; ?>

            </div>

        </div>

    </main>

</div>

</body>
</html>