<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}

$prof = $_SESSION['user'];
$prof_id = $prof['id'];

$sql = "SELECT DISTINCT 
    classes.id,
    classes.name,
    classes.classroom_number
FROM classes
JOIN students ON students.class_id = classes.id
JOIN enrollments ON enrollments.student_id = students.id
JOIN courses ON enrollments.course_id = courses.id
WHERE courses.prof_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$prof_id]);

$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard professeur - EduSync</title>
    <!-- استعملت السطر اللي عطيتيني ديال Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<!-- زدت flex باش يجي Sidebar حدا المحتوى -->
<body class="bg-gray-100 min-h-screen flex">

    <!-- 1. SIDEBAR (اللي عطيتيني) -->
    <aside class="w-64 bg-slate-900 min-h-screen text-white p-4 hidden md:block sticky top-0">
        <h2 class="text-xl font-bold text-blue-400 mb-8 px-2">EduSync Prof</h2>
        <nav class="space-y-2">
            <a href="../professor/mycourses.php" class="block py-2.5 px-4 rounded hover:bg-slate-800 text-white transition"> Mes Cours</a>
            <a href="../professor/dashboard.php" class="block py-2.5 px-4 rounded bg-blue-600 text-white">dashboard</a>
            
            <a href="../professor/student_list.php" class="block py-2.5 px-4 rounded hover:bg-slate-800 text-white">list de Etudients</a>
            <a href="../auth/logout.php" class="block py-2.5 px-4 rounded hover:bg-red-600 transition text-white">Logout</a>
        </nav>
    </aside>

    
    <main class="flex-1 p-8">
        
        
        <div class="bg-white p-6 rounded-xl shadow-sm mb-8 border border-gray-100 flex justify-between items-center">
            <div>
                <h3 class="text-xl font-semibold text-gray-700">
                    Bienvenue, <span class="text-blue-600"><?= htmlspecialchars($prof['firstname']) ?> <?= htmlspecialchars($prof['lastname']) ?></span>
                </h3>
                <p class="text-sm text-gray-400">Gérez vos classes et vos étudiants depuis cet espace.</p>
            </div>
            <div class="text-xs text-gray-400 font-mono italic">Role: Professeur</div>
        </div>

        <div class="flex items-center gap-3 mb-6">
            <div class="w-2 h-8 bg-blue-600 rounded-full"></div>
            <h1 class="text-2xl font-bold text-gray-800">Mes classes</h1>
        </div>

        
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-gray-600 border-b border-gray-100 text-sm">
                    <tr>
                        <th class="p-4 font-bold uppercase tracking-wider">ID</th>
                        <th class="p-4 font-bold uppercase tracking-wider text-center">Classe</th>
                        <th class="p-4 font-bold uppercase tracking-wider text-center">Salle</th>
                        <th class="p-4 font-bold uppercase tracking-wider text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-50">
                    <?php if (!empty($classes)): ?>
                        <?php foreach ($classes as $class): ?>
                            <tr class="hover:bg-blue-50/50 transition">
                                <td class="p-4 text-gray-400 font-mono text-sm"><?= $class['id'] ?></td>
                                <td class="p-4 font-bold text-gray-800 text-center">
                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-md">
                                        <?= htmlspecialchars($class['name']) ?>
                                    </span>
                                </td>
                                <td class="p-4 text-gray-600 text-center font-medium">
                                    Salle: <?= htmlspecialchars($class['classroom_number']) ?>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="course_students.php?course_id=<?= $class['id'] ?>" 
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold rounded-lg transition duration-200 text-sm">
                                        Voir étudiants
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?> 
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="p-20 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-4 text-gray-200"></span>
                                    Aucune classe trouvée pour votre compte.
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>