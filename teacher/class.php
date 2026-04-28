<?php

session_start();

require_once '../db.php';
if (!isset($_SESSION['user.id'])){
header("location:../login.php");
exit();
}
$professor=$_SESSION['user.id'];

$sql= "SELECT DISTINCT FROM classes.id, classes.nom, classes.classeroom_number
from classes
join courses
on courses.prof_id =:prof_id
";