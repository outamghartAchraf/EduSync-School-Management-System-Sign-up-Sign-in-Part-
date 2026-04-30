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
    <title>EduSync - Liste des Étudiants</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 min-h-screen text-white p-6 sticky top-0">
        <h2 class="text-2xl font-bold text-blue-500 mb-10">EduSync Prof</h2>
        <nav class="space-y-4">
            <a href="mycourses.php" class="block p-3 rounded hover:bg-slate-800 transition"> Mes Cours</a>
            <a href="students_list.php" class="block p-3 rounded bg-blue-700"> Étudiants</a>
            <hr class="border-slate-700 my-4">
            <a href="../auth/logout.php" class="block p-3 rounded hover:bg-red-600 transition">Logout</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <div class="max-w-6xl mx-auto">
            
            <header class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-800">Students of My Courses</h1>
                <p class="text-gray-500">Liste globale de tous les étudiants inscrits à vos modules.</p>
            </header>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <table class="w-full text-left">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider">Course</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider">Full Name</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider">Student Number</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider">Email</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-center">Status</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    <?php if (!empty($rows)): ?>
                        <?php foreach ($rows as $r): ?>
                            <tr class="hover:bg-blue-50/50 transition">
                                <td class="p-4">
                                    <span class="bg-blue-100 text-blue-700 text-[10px] font-bold px-2 py-1 rounded uppercase">
                                        <?= htmlspecialchars($r['title']) ?>
                                    </span>
                                </td>
                                <td class="p-4 font-medium text-gray-800">
                                    <?= htmlspecialchars($r['firstname'] . ' ' . $r['lastname']) ?>
                                </td>
                                <td class="p-4 text-gray-500 font-mono text-sm">
                                    <?= htmlspecialchars($r['student_number']) ?>
                                </td>
                                <td class="p-4 text-blue-600 text-sm italic">
                                    <?= htmlspecialchars($r['email']) ?>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 text-xs font-bold rounded-full 
                                        <?= $r['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' ?>">
                                        <?= ucfirst($r['status']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-20 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-4"></span>
                                    No students found for your courses
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>