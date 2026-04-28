<?php
session_start();
require_once '../db.php';
if (!isset($_SESSION['user.id'])){
header("location:../login.php");

}