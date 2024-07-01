<?php
session_start();
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "km_project"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password if you are storing hashed passwords
    // $password = md5($password);

    $sql = "SELECT * FROM `user_table` WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['peran'] = $row['peran'];

            if ($row['peran'] == 'staf') {
                header("Location: admin.php");
            } elseif ($row['peran'] == 'mahasiswa') {
                header("Location: index.php");
            } else {
                echo "Invalid role!";
            }
            exit();
        }
    } else {
        echo "Invalid email or password!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Universitas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background: #f3f4f6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    text-align: center;
}

.login-box {
    width: 100%;
}

.logo {
    width: 100px;
    margin-bottom: 20px;
}

h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.textbox {
    margin-bottom: 20px;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.textbox input {
    width: 100%;
    padding: 10px;
    background: #f1f1f1;
    border: none;
    outline: none;
    border-radius: 4px;
    font-size: 16px;
}

.textbox input:focus {
    background: #e9e9e9;
}

.btn {
    width: 100%;
    padding: 10px;
    background: #007bff;
    border: none;
    outline: none;
    border-radius: 4px;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

.btn:hover {
    background: #0056b3;
}
</style>
<body>
    <div class="container">
        <div class="login-box">
            <img src="logo_petra.png" alt="Logo Universitas Kristen Petra" class="logo">
            <h2>Login Universitas</h2>
            <form action="login.php" method="post">
                <div class="textbox">
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="Password" name="password" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
