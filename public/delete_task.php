<?php
include_once('../config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task_id]);

    header("Location: index.php");
}
?>