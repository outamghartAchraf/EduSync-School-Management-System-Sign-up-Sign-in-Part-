<?php
session_start();

require_once '../config/db.php';

if(!isset($_SESSION['user_id'])|| $_SESSION['role'] !=='prof'){
    header("Location: ../auth/login.php");
    exit;
}
$prof_id = $_SESSION['user_id'];

try{
    $stmt = $conn->prepare("SELECT id, title, description FROM courses WHERE teacher_id =?");
    $stmt ->execute([$prof_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Error: ". $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des etudiants</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-80">
    <div class="max-w-4xl mx-auto">
        <a href="mycourses.php" class="text-blue-600 hover:underline mb-6 inline-block">← Retour a mes cours</a>
        <h1 class="text-2xl font-bold mb-6">Liste des etudiants inscrits</h1>

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
                    <?php foreach($students as $s): ?>
                    <tr class="border-t border-gray-100">
                        <td class="p-4"><?= htmlspecialchars($s['firtname'].''. $s['lastename']) ?></td>
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