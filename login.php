<?php
require("db.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $batch_code = $_POST['batch_code'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $mysqli->prepare("SELECT password FROM student_info WHERE name = ? AND batch_code = ?");
    $stmt->bind_param("ss", $name, $batch_code);
    $stmt->execute();
    $stmt->store_result();

    // Check if the combination exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Start the session and redirect to a welcome page or dashboard
            $_SESSION['name'] = $name;
            $_SESSION['batch_code'] = $batch_code;
            header('Location: student_panel.php');
            exit;
        } else {
            $error = "Invalid password. Please try again.";
        }
    } else {
        $error = "No user found with that name and batch code combination.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        .submit-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #007BFF;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>LOGIN</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter Your Name" required>
            </div>

            <div class="form-group">
                <label for="batch_code">Batch Code:</label>
                <input type="text" name="batch_code" id="batch_code" placeholder="Enter Batch Code" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" placeholder="Enter Password" required>
            </div>

            <button type="submit" class="submit-btn">Login</button>
        </form>
        <div class="links">
            <p>Don't have an account? <a href="student_reg.php">Sign up here</a>.</p>
        </div>
    </div>
</body>

</html>