<?php
include_once('../config/config.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$task_id]);
    $task = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];

        $sql = "UPDATE tasks SET title = ?, description = ?, due_date = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $description, $due_date, $task_id]);

        header("Location: index.php");
    }
} else {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form action="edit_task.php?id=<?= $task['id'] ?>" method="post">
        <input type="text" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
        <textarea name="description"><?= htmlspecialchars($task['description']) ?></textarea>
        <input type="datetime-local" name="due_date" value="<?= $task['due_date'] ?>" required>
        <button type="submit">Update Task</button>
    </form>
</body>
</html>