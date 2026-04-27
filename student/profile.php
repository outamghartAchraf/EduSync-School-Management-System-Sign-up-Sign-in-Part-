
<?php
session_start();
include '../config/db.php';


   
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profil Étudiant</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white shadow-xl rounded-2xl w-96 overflow-hidden">

    <!-- Header -->
    <div class="bg-indigo-500 h-28"></div>

    <!-- Photo -->
    <div class="flex justify-center">
      <img src="https://share.google/p3PokoO3N4ingeRSd"
           class="w-28 h-28 rounded-full border-4 border-white -mt-14"
           alt="student">
    </div>

    <!-- Infos -->
    <div class="text-center p-5">
      <h2 class="text-2xl font-bold">Asma Tasmat</h2>
      <p class="text-gray-500">Étudiante en Développement Web</p>

      <div class="mt-4 text-left space-y-2">
        <p><strong>📧 Email :</strong> asma@email.com</p>
        <p><strong>📞 Téléphone :</strong> 06 12 34 56 78</p>
        <p><strong>🏫 École :</strong> IFTL Nouaceur</p>
        <p><strong>📚 Niveau :</strong> Licence Professionnelle</p>
      </div>

   
     
    </div>

  </div>

</body>
</html>