<?php
include 'db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "not working";
    // header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Retrieve the student's details
$user_id = $_SESSION['user_id'];
$stmt = $mysqli->prepare("SELECT name, batch_code FROM student_info WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($student_name, $batch_code);
$stmt->fetch();
$stmt->close();

// Handle file submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assignment_id = $_POST['assignment_id'];
    $target_file = "uploads/" . basename($_FILES["file"]["name"]);

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $stmt = $mysqli->prepare("INSERT INTO submissions (assignment_id, user_id, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $assignment_id, $user_id, $target_file);
        $stmt->execute();
        $stmt->close();
        $upload_message = "File uploaded successfully.";
    } else {
        $upload_message = "Error uploading file.";
    }
}

// Retrieve assignments that match the student's batch code
$stmt = $mysqli->prepare("SELECT * FROM assignments WHERE batch_code = ?");
$stmt->bind_param("s", $batch_code);
$stmt->execute();
$assignments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            display: inline;
        }
        input[type="file"] {
            margin-right: 5px;
        }
        .message {
            color: green;
            margin: 10px 0;
        }
        .error {
            color: red;
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
    <h2>Student Panel</h2>
    <h3>Welcome, <?= htmlspecialchars($student_name) ?> (Batch Code: <?= htmlspecialchars($batch_code) ?>)</h3>
    
    <?php if (isset($upload_message)): ?>
        <p class="message"><?= htmlspecialchars($upload_message) ?></p>
    <?php endif; ?>

    <h3>Available Assignments</h3>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Submit</th>
        </tr>
        <?php if (empty($assignments)): ?>
            <tr>
                <td colspan="4">No assignments available for your batch.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($assignments as $assignment): ?>
                <tr>
                    <td><?= htmlspecialchars($assignment['title']) ?></td>
                    <td><?= htmlspecialchars($assignment['description']) ?></td>
                    <td><?= htmlspecialchars($assignment['due_date']) ?></td>
                    <td>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="assignment_id" value="<?= $assignment['id'] ?>">
                            Upload File: <input type="file" name="file" required>
                            <input type="submit" value="Submit">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
