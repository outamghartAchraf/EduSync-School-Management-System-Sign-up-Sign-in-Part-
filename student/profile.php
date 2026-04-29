<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$id = $_SESSION['user']['id'];

$sqlState = $pdo->prepare("
    SELECT 
        users.firstname, 
        users.lastname, 
        users.email AS Email, 
        students.id AS student_id,
        classes.name AS class_name
    FROM users
    LEFT JOIN students ON users.id = students.user_id
    LEFT JOIN classes ON students.class_id = classes.id
    WHERE users.id = ?
");

$sqlState->execute([$id]);
$user = $sqlState->fetch(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-r from-indigo-100 to-purple-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-2xl rounded-2xl w-[350px] overflow-hidden">

    <?php if ($user): ?>

    <!-- Header -->
    <div class="bg-indigo-500 h-24 relative">
        <div class="absolute -bottom-10 left-1/2 transform -translate-x-1/2">
            <img 
                src="https://ui-avatars.com/api/?name=<?= urlencode($user->firstname . ' ' . $user->lastname) ?>&background=ffffff&color=4f46e5"
                class="w-20 h-20 rounded-full border-4 border-white shadow-md">
        </div>
    </div>

    <!-- Content -->
    <div class="pt-12 pb-6 text-center px-6">

        <h2 class="text-xl font-bold text-gray-800">
            <?= htmlspecialchars($user->firstname) ?> <?= htmlspecialchars($user->lastname) ?>
        </h2>

        <p class="text-gray-500 mt-1">
            <?= htmlspecialchars($user->Email) ?>
        </p>

        <div class="mt-4 border-t pt-4 text-sm text-gray-600">
            <p>
                <span class="font-semibold">Classe :</span> 
                <?= $user->class_name ? htmlspecialchars($user->class_name) : 'Pas de classe' ?>
            </p>
        </div>

      

    </div>

    <?php else: ?>

        <div class="p-6 text-center">
            <p class="text-red-500 font-semibold">Utilisateur non trouvé</p>
        </div>

    <?php endif; ?>

</div>

</body>
</html>