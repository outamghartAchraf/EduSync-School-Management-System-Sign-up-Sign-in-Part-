<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashbord de professeur</title>
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>
Bienvenue <?= $prof['firstname'] ?> <?= $prof['lastname'] ?>
</h3>
    
<h1>Mes classe</h1>
 <table border="1">

 <tr class="bg-blue-400">
<td class="border p-2"> ID</td>
<td class="border p-2"> Class</td>
<td class="border p-2">Salle</td>
<td class="border p-2"> Action</td>

 </tr>
<?php foreach ($classes as $class):?>

     <tr class="bg-blue-400">
<td class="border p-2"><?= $class['id']?></td>
<td class="border p-2"><?= $class['name']?></td>
<td class="border p-2"><?= $class['classroom_number']?></td>


 </tr>

<?php endforeach; ?>

 </table>

</body>
</html>