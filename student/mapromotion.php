
<?php
session_start();
$_SESSION['id_class'] = $user['id_class'];
include '../config/db.php';

$db = new PDO('mysql:host=localhost;dbname=ecole;charset=utf8', 'root', '');

$id_class = $_SESSION['id_class'];

$sql = "SELECT * FROM students WHERE id_class = :id_class";
$stmt = $db->prepare($sql);
$stmt->execute(['id_class' => $id_class]);

$students = $stmt->fetchAll();  ?>




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
      Liste des etudients 
    </h1>

    <!-- Card -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

      <!-- Liste -->
      <ul class="divide-y">


        <li class="p-4 hover:bg-gray-50 font-medium">          
        <?= htmlspecialchars($students['id_student']) . " " . htmlspecialchars($students['id-class']); ?>

        </li>

        

      </ul>

    </div>

  </div>

</body>
</html>