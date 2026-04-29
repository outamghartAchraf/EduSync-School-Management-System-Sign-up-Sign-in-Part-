<?php
session_start();
include '../config/db.php';

// Vérifier si connecté
if (!isset($_SESSION['user'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id = $_SESSION['user']['id'];

// Requête : camarades même classe
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

<body class="bg-gray-100 p-6">

  <div class="max-w-xl mx-auto">

    <!-- Titre -->
    <h1 class="text-2xl font-bold text-center mb-6">
      👥 Liste des étudiants
    </h1>

    <!-- Card -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

      <!-- Liste -->
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

</body>
</html>