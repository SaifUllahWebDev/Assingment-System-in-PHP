<?php
require("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $department = $_POST['department'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT password FROM teacher_info WHERE name = ? AND department = ?");
    $stmt->bind_param("ss", $name, $department);
    $stmt->execute();
    $stmt->store_result();

    // Check if the combination exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start the session and redirect to the teacher panel
            $_SESSION['name'] = $name;
            $_SESSION['department'] = $department;
            header('Location: teacher_panel.php');
            exit;
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No user found with that name or department.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .form {
            background-color: #fff;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: auto;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin: 10px 0;
        }
        a {
            display: block;
            text-align: center;
            color: #007BFF;
            text-decoration: none;
            margin-top: 10px;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="form">
        <h1>TEACHER LOGIN</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="teacher_login.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter Your Name" required>

            <label for="department">Department:</label>
            <input type="text" name="department" id="department" placeholder="Enter Your Department" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter Password" required>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="teacher_reg.php">Sign up here</a>.</p>
    </div>
</body>

</html>
