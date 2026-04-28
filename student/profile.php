<?php
session_start();
include '../config/db.php';



$db = new PDO('mysql:host=localhost;dbname=ecole;charset=utf8', 'root', '');
$sql = "SELECT * FROM users";
$query = $db->query($sql);
$users = $query->fetchAll();


?>
 

   
<? if($_SESSION['user']['role_id'] == 3){
     $user['role_id']; 
} ?>



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
            <h2 class="text-2xl font-bold"><?php foreach ($users as $user) { ?>
                    <h1><?= $user['firstname']; ?></h1>
                    <p class="text-gray-500"><?= $user['role_id']; ?></p>
                    <div class="mt-4 text-left space-y-2">
                        <p><strong>📧 Email :</strong> <?= $user['email']; ?></p>
                       <?php } ?>
                    </div>
        </div>
         </div>
    </div>
</body>

</html>