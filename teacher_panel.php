<?php
include 'db.php';
session_start();

// Check if the user is logged in and has the teacher role
if (!isset($_SESSION['name']) || !isset($_SESSION['department'])) {
    header('Location: teacher_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];
    $batch_code = $_POST['batch_code']; // New field for batch code

    $stmt = $mysqli->prepare("INSERT INTO assignments (title, description, due_date, batch_code) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $due_date, $batch_code);
    $stmt->execute();
    $stmt->close();

    // Message to indicate success
    $success_message = "Assignment created successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Panel</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="datetime-local"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            margin: 10px 0;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <h2>Teacher Panel</h2>
    <h3>Create Assignment</h3>

    <?php if (isset($success_message)): ?>
        <p class="message"><?= htmlspecialchars($success_message) ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="due_date">Due Date:</label>
        <input type="datetime-local" name="due_date" id="due_date" required>

        <label for="batch_code">Batch Code:</label>
        <input type="text" name="batch_code" id="batch_code" required>

        <input type="submit" value="Create Assignment">
    </form>
    <a href="logout.php">Logout</a>
</body>

</html>