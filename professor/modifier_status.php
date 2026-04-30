
<?php
session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
} else {
    $status = null;
}