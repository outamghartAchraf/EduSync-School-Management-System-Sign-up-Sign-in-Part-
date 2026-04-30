<?php
session_start();
include '../config/db.php';


if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id = $_SESSION['user']['id'];


$sql = $pdo->prepare("
    SELECT 
        u.firstname,
        u.lastname,
        s.student_number
    FROM students s
    INNER JOIN users u ON u.id = s.user_id
    WHERE s.class_id = (
        SELECT class_id 
        FROM students 
        WHERE user_id = ?
    )
    AND s.user_id != ?
");

$sql->execute([$id, $id]);
$students = $sql->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des camarades</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="flex">

   
    <aside class="w-64 bg-blue-600 text-white min-h-screen fixed shadow-lg">

        <div class="px-5 py-4 text-xl font-bold">
            🎓 EduSync
        </div>

        <hr class="border-blue-400">

        <nav class="mt-4 flex flex-col gap-1 px-3">

            <a href="dashboard.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                📊 Dashboard
            </a>

            <a href="myprogramme.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                📚 Mon Programme
            </a>

            <!-- ACTIVE -->
            <a href="mapromotion.php" class="px-4 py-2 rounded-md bg-blue-500 font-semibold">
                👥 Camarades
            </a>

            <a href="profile.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                👤 Profile
            </a>

            <a href="details.php" class="px-4 py-2 rounded-md hover:bg-blue-500">
                ℹ️ Details
            </a>

        </nav>

        <div class="absolute bottom-0 w-full px-5 py-4 border-t border-blue-400">
            <a href="../auth/logout.php" class="text-yellow-300 hover:text-yellow-400">
                🚪 Logout
            </a>
        </div>

    </aside>


    
    <main class="ml-64 w-full p-6">

        <div class="max-w-xl mx-auto">

            <h1 class="text-2xl font-bold text-center mb-6">
                👥 Liste des étudiants
            </h1>

       
            <div class="bg-white shadow rounded-xl overflow-hidden">

                <ul class="divide-y">

                <?php if (!empty($students)): ?>

                    <?php foreach ($students as $student): ?>

                    <li class="p-4 hover:bg-gray-50 flex justify-between items-center">

                        <div>
                            <p class="font-medium">
                                <?= htmlspecialchars($student->firstname . ' ' . $student->lastname) ?>
                            </p>

                            <p class="text-sm text-gray-500">
                                ID: <?= htmlspecialchars($student->student_number) ?>
                            </p>
                        </div>

                        <span class="bg-indigo-100 text-indigo-600 px-3 py-1 rounded-full text-xs font-semibold">
                            Student
                        </span>

                    </li>

                    <?php endforeach; ?>

                <?php else: ?>

                    <li class="p-4 text-center text-red-500 font-semibold">
                        Aucun camarade trouvé
                    </li>

                <?php endif; ?>

                </ul>

            </div>

        </div>

    </main>

</div>

</body>
</html>