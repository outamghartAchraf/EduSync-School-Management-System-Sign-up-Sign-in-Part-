<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}


// echo "<pre>";
// var_dump($_SESSION);
// echo "</pre>";
// exit;

$prof = $_SESSION['user'];
$prof_id = $prof['id'];

$sql = "SELECT DISTINCT 
    classes.id,
    classes.name,
    classes.classroom_number
FROM classes
JOIN courses ON classes.id = courses.classe_id
WHERE courses.prof_id = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$prof_id]);

$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo count($classes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard professeur</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<!-- HEADER -->
<div class="bg-white p-4 rounded-xl shadow mb-6">
    <h3 class="text-xl font-semibold text-gray-700">
        Bienvenue <?= $prof['firstname'] ?> <?= $prof['lastname'] ?>
    </h3>
</div>

<!-- TITLE -->
<h1 class="text-2xl font-bold mb-4 text-gray-800">
    Mes classes
</h1>


<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-200 text-gray-700">
            <tr>
   <th class="p-3">ID</th>
   <th class="p-3">Classe</th>
    <th class="p-3">Salle</th>
     <th class="p-3">Action</th>
     </tr>
        </thead>

        <tbody>
        <?php if (!empty($classes)): ?>
     <?php foreach ($classes as $class): ?>
      <tr class="border-b hover:bg-gray-50">
     <td class="p-3"><?= $class['id'] ?></td>
    <td class="p-3 font-medium"><?= $class['name'] ?></td>
    <td class="p-3"><?= $class['classroom_number'] ?></td>
     <td class="p-3"><a href="class.php?id=<?= $class['id'] ?>" class="text-blue-600 hover:underline">Voir </a>  </td>
 </tr>
    <?php endforeach; ?> 
     <?php else: ?>
            <tr>
         <td colspan="4" class="p-4 text-center text-gray-500"> Aucune classe trouvée </td>
            </tr>
          <?php endif; ?>
    </tbody>
       </table>
</div>


<div class="mt-6">
    <a href="../auth/logout.php"
       class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
        Logout
    </a>
</div>

</body>
</html>