<?php
session_start();

require_once '../config/db.php';

if(!isset($_SESSION['user_id'])|| $_SESSION['role'] !=='prof'){
    header("Location: ../auth/login.php");
    exit;
}
$prof_id = $_SESSION['user_id'];

try{
    $stmt = $conn->prepare("SELECT id, title, description FROM courses WHERE teacher_id =?");
    $stmt ->execute([$prof_id]);
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

}catch(PDOException $e){
    die("Error: ". $e->getMessage());
}
?>
