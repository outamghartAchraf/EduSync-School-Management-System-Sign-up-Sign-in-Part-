<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'prof') {
    header("Location: ../auth/login.php");
    exit;
}
$course_id = $_GET['course_id'] ?? null;
if (! $course_id){ header("Location: mycourses.php"); 
exit;
}
$stmt = $conn->prepare($query);
$stmt->execute([$course_id]);
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des étudiants</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto">
        <a href="mycourses.php" class="text-blue-600 hover:underline mb-6 inline-block">← Retour à mes cours</a>
        <h1 class="text-2xl font-bold mb-6">Liste des étudiants inscrits</h1>

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 font-semibold text-gray-700">Nom Complet</th>
                        <th class="p-4 font-semibold text-gray-700">Email</th>
                        <th class="p-4 font-semibold text-gray-700">Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $s): ?>
                    <tr class="border-t border-gray-100">
                        <td class="p-4"><?= htmlspecialchars($s['first_name'] . ' ' . $s['last_name']) ?></td>
                        <td class="p-4 text-gray-600"><?= htmlspecialchars($s['email']) ?></td>
                        <td class="p-4">
                            <span class="px-2 py-1 text-xs font-bold rounded <?= $s['status'] == 'Actif' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' ?>">
                                <?= $s['status'] ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>