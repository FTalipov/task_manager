<?php
include_once('../config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $sql = "INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$title, $description, $due_date]);

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
</head>
<body>
    <h1>Add New Task</h1>
    <form action="add_task.php" method="post">
        <input type="text" name="title" required placeholder="Task title">
        <textarea name="description" placeholder="Task description"></textarea>
        <input type="datetime-local" name="due_date" required>
        <button type="submit">Add Task</button>
    </form>
</body>
</html>