<?php

session_start();

require_once '../db.php';

if (!isset($_SESSION['user_id'])) {
    header("location:../login.php");
    exit();
}

$professor = $_SESSION['user_id'];

$sql = "
SELECT DISTINCT classes.id, classes.name, classes.classroom_number
FROM classes
JOIN courses ON classes.id = courses.classe_id
WHERE courses.prof_id = :prof_id
";

$stm = $pdo->prepare($sql);

$stm->execute([
    'prof_id' => $professor
]);

$classes = $stm->fetchAll(PDO::FETCH_ASSOC);
?>