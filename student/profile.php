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
<title>Profil etudiant</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-purple-100 min-h-screen">

<div class="flex">

   
    <aside class="w-64 bg-indigo-600 text-white min-h-screen p-5 fixed">

        <h2 class="text-2xl font-bold mb-8">EduSync</h2>

        <nav class="space-y-3">

            <a href="dashboard.php" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                <span>Dashboard</span>
            </a>

            <a href="myprogramme.php" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                <span>Mon Programm</span>
            </a>

            <a href="mapromotion.php" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                 <span>Promotion</span>
            </a>

            <a href="profile.php" class="flex items-center gap-3 p-2 rounded-lg bg-indigo-500">
                <span>Profile</span>
            </a>

            <a href="details.php" class="flex items-center gap-3 p-2 rounded-lg hover:bg-indigo-500 transition">
                 <span>Details</span>
            </a>

        </nav>

        <div class="mt-10 border-t border-indigo-400 pt-4">
            <a href="../auth/logout.php" class="flex items-center gap-3 text-yellow-300 hover:text-yellow-400">
                🚪 Logout
            </a>
        </div>

    </aside>


    <main class="ml-64 w-full flex items-center justify-center p-6">

        <div class="max-w-md w-full">

        <?php if ($user): ?>

      
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <!-- COVER -->
            <div class="h-32 bg-gradient-to-r from-indigo-500 to-purple-600 relative">

                <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                    <img 
                        src="https://ui-avatars.com/api/?name=<?= urlencode($user->firstname . ' ' . $user->lastname) ?>&background=ffffff&color=4f46e5"
                        class="w-24 h-24 rounded-full border-4 border-white shadow-lg">
                </div>

            </div>

          
            <div class="pt-16 pb-6 px-6 text-center">

                <h2 class="text-2xl font-bold text-gray-800">
                    <?= htmlspecialchars($user->firstname) ?> <?= htmlspecialchars($user->lastname) ?>
                </h2>

                <p class="text-gray-500 mt-1 text-sm">
                     <?= htmlspecialchars($user->Email) ?>
                </p>

                <span class="inline-block mt-3 bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-xs font-semibold">
                    etudiant
                </span>

                <div class="mt-6 space-y-3 text-sm">

                    <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                        <p class="text-gray-500">Classe</p>
                        <p class="font-semibold text-gray-800">
                            <?= $user->class_name ?? 'Non assignée' ?>
                        </p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl shadow-sm">
                        <p class="text-gray-500">ID etudiant</p>
                        <p class="font-semibold text-indigo-600">
                            <?= $user->student_id ?? '---' ?>
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <?php else: ?>

        <div class="bg-white p-6 rounded-xl shadow text-center">
            <p class="text-red-500 font-semibold">Utilisateur non trouve</p>
        </div>

        <?php endif; ?>

        </div>

    </main>

</div>

</body>
</html>