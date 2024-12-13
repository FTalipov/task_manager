<?php
include_once('../config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM tasks";
$stmt = $pdo->query($sql);
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
</head>
<body>
    <h1>Task Manager</h1>
    <a class="  " href="add_task.php">Add new task</a>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <?= htmlspecialchars($task['title']) ?> - <?= htmlspecialchars($task['due_date']) ?>
                <a href="edit_task.php?id=<?= $task['id'] ?>">Edit</a>
                <a href="delete_task.php?id=<?= $task['id'] ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>