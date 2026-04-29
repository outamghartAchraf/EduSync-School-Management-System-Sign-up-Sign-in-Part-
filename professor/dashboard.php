<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}

$prof = $_SESSION['user'];
$prof_id = $prof['id'];

$sql = "
SELECT DISTINCT 
    classes.id,
    classes.name,
    classes.classroom_number
FROM classes
JOIN courses ON classes.id = courses.classe_id
WHERE courses.prof_id = :prof_id
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['prof_id' => $prof_id]);

$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard professeur</title>
</head>

<body>

<h3>

Bienvenue <?= $prof['firstname'] ?> <?= $prof['lastname'] ?>
</h3>

<h1>Mes classes</h1>

<table border="1">

<tr>
    <th>ID</th>
    <th>Classe</th>
    <th>Salle</th>
    <th>Action</th>
</tr>
<?php if (!empty($classes)): ?>
    <?php foreach ($classes as $class): ?>
        <tr>
            <td><?= $class['id'] ?></td>
            <td><?= $class['name']?></td>
            <td><?= $class['classroom_number'] ?></td>
            <td>
                <a href="class.php?id=<?= $class['id'] ?>">Voir</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="4">Aucune classe trouvée</td>
    </tr>
<?php endif; ?>

</table>

<a href="../auth/logout.php" >logout</a>

</body>
</html>