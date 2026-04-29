<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'prof') {
    header("Location: ../auth/login.php");
    exit;
}

$course_id = $_GET['course_id'] ?? null;
if (!$course_id) { 
    header("Location: mycourses.php"); 
    exit;
}

try {
    
    $query = "SELECT u.firstname, u.lastname, u.email, s.student_number, e.status 
              FROM enrollments e
              JOIN students s ON e.student_id = s.id
              JOIN users u ON s.user_id = u.id
              WHERE e.course_id = ?";
              
    $stmt = $conn->prepare($query);
    $stmt->execute([$course_id]);
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    $cStmt = $conn->prepare("SELECT title FROM courses WHERE id = ?");
    $cStmt->execute([$course_id]);
    $course_title = $cStmt->fetchColumn();

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants - EduSync</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-5xl mx-auto">
        <a href="mycourses.php" class="text-blue-600 hover:text-blue-800 font-medium mb-6 inline-flex items-center transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
            Retour à mes cours
        </a>
        
        <h1 class="text-3xl font-bold mb-2 text-gray-800 italic"><?= htmlspecialchars($course_title) ?></h1>
        <p class="text-gray-500 mb-8">Liste des étudiants inscrits à ce module.</p>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-900 text-white">
                    <tr>
                        <th class="p-4 font-semibold uppercase text-xs">Nom Complet</th>
                        <th class="p-4 font-semibold uppercase text-xs">N° Étudiant</th>
                        <th class="p-4 font-semibold uppercase text-xs">Email</th>
                        <th class="p-4 font-semibold uppercase text-xs text-center">Statut</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (count($students) > 0): ?>
                        <?php foreach ($students as $s): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">
                                <?= htmlspecialchars($s['firstname'] . ' ' . $s['lastname']) ?>
                            </td>
                            <td class="p-4 text-gray-500 font-mono text-sm">
                                <?= htmlspecialchars($s['student_number']) ?>
                            </td>
                            <td class="p-4 text-blue-600 text-sm italic">
                                <?= htmlspecialchars($s['email']) ?>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 text-xs font-bold rounded-full 
                                    <?= $s['status'] === 'active' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' ?>">
                                    <?= ucfirst($s['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="p-10 text-center text-gray-400 italic">
                                Aucun étudiant inscrit dans ce cours.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>