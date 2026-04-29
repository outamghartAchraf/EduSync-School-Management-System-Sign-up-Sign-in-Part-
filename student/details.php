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
  <title>Mes matières</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-100 to-purple-100 min-h-screen p-6">

<div class="max-w-6xl mx-auto">

  <div class="flex justify-between items-center mb-8">
    <h1 class="text-3xl font-bold text-gray-800">📚 Mes matières</h1>

    
  </div>

 
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

    <?php if (!empty($courses)): ?>

        <?php foreach($courses as $course): ?>

        <div class="bg-white p-5 rounded-2xl shadow hover:shadow-xl transition duration-300">

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
                Aucun cours trouvé
            </p>
        </div>

    <?php endif; ?>

  </div>

</div>

</body>
</html>