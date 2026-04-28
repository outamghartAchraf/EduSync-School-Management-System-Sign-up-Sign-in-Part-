<?php
session_start();
include '../config/db.php';

$id = $_SESSION['user']['id'];

$sqlState = $pdo->prepare("
    SELECT users.firstname, users.lastname, users.email AS Email, students.id_student
    FROM users
    LEFT JOIN students ON users.id_user = students.id_user
    WHERE users.id_user = ?
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

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-xl rounded-2xl w-96 overflow-hidden">
        <div class="bg-indigo-500 h-28"></div>
        <div class="text-center p-5">
            <h2 class="text-2xl font-bold">
                <?php if ($user): ?>
                    <h1><?= $user->firstname ?></h1>
                    <p><?= $user->lastname ?></p>
                    <p><?= $user->Email ?></p>
                <?php else: ?>
                    <p>User not found</p>
                <?php endif; ?>

        </div>
    </div>
    </div>
    </div>
</body>

</html>