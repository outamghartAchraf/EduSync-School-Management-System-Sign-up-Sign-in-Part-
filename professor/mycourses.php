<?php
session_start();
require_once '../config/db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'prof'){
    header("Location: ../auth/login.php");
    exit;
}

$prof_id = $_SESSION['user_id'];

try {

    $stmt = $pdo->prepare("SELECT id, title, description, total_hours FROM courses WHERE prof_id = ?");
    $stmt->execute([$prof_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Error: ". $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-slate-900 min-h-screen text-white p-4 hidden md:block">
        <h2 class="text-xl font-bold text-blue-400 mb-8 px-2">EduSync Prof</h2>
        <nav class="space-y-2">
            <a href="mycourses.php" class="block py-2.5 px-4 rounded bg-blue-600 text-white">📚 Mes Cours</a>
            <a href="../auth/logout.php" class="block py-2.5 px-4 rounded hover:bg-red-600 transition">Logout</a>
        </nav>
    </aside>

    <main class="flex-1 p-8">
        <header class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800">Mes Enseignements</h1>
            <div class="text-sm text-gray-500 italic">
                Connecté: <span class="font-bold text-blue-600"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Professeur') ?></span>
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (count($courses) > 0): ?>
                <?php foreach ($courses as $course): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-xl">📖</div>
                            <span class="text-xs font-mono bg-gray-100 px-2 py-1 rounded text-gray-500"><?= $course['total_hours'] ?>h total</span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 mb-2"><?= htmlspecialchars($course['title']) ?></h2>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-2"><?= htmlspecialchars($course['description']) ?></p>
                        
                        <a href="students_list.php?course_id=<?= $course['id'] ?>" 
                           class="flex items-center justify-center w-full py-2 bg-gray-50 hover:bg-blue-600 hover:text-white text-blue-600 font-semibold rounded-lg border border-blue-100 transition duration-300">
                            Voir les étudiants
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full py-12 text-center bg-white rounded-xl border-2 border-dashed border-gray-200">
                    <p class="text-gray-500 italic">Aucun cours assigné pour le moment.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

</body>
</html>