<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "Session ID not set. Redirecting to login.";
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "km_project"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user information
$id = $_SESSION['id'];
$sql = "SELECT nama_lengkap, jabatan FROM user WHERE id = $id";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
$user = $result->fetch_assoc();
if (!$user) {
    die("User not found.");
}

// Fetch data for the table
$sql_kegiatan = "SELECT * FROM kegiatan"; // Assuming the table name is 'kegiatan'
$result_kegiatan = $conn->query($sql_kegiatan);
if (!$result_kegiatan) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .top-bar {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .top-bar .welcome-message {
            font-size: 16px;
        }
        .top-bar .logout-button {
            background: #dc3545;
            border: none;
            padding: 8px 12px;
            color: #fff;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
        }
        .container {
            width: 95%;
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            overflow-x: auto;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
            text-align: center;
        }
        .add-button {
            display: block;
            width: 200px;
            padding: 10px;
            margin: 20px auto;
            background: #007bff;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
            font-size: 16px;
        }
        .add-button:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background: #f7f7f7;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .btn-detail {
            background: #28a745;
        }
        .btn-detail:hover {
            background: #218838;
        }
        .btn-accept {
            background: #007bff;
        }
        .btn-accept:hover {
            background: #0056b3;
        }
        .btn-reject {
            background: #dc3545;
        }
        .btn-reject:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="welcome-message">
            Selamat datang, <?php echo htmlspecialchars($user['nama_lengkap']); ?> (<?php echo htmlspecialchars($user['jabatan']); ?>)
        </div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <a href="input_data.php" class="add-button">Tambah Kegiatan</a>
        <table>
            <thead>
                <tr>
                    <th>Unit Akademik/Pendukung</th>
                    <th>Nama Kegiatan</th>
                    <th>Tempat</th>
                    <th>Periode</th>
                    <th>Jenis Kepanitiaan</th>
                    <th>Lingkup</th>
                    <th>Telepon HP/Extension</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_kegiatan->num_rows > 0) {
                    while($row = $result_kegiatan->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["unit"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nama"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["tempat"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["periode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lingkup"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["telepon"]) . "</td>";
                        echo "<td class='action-buttons'>";
                        echo "<button class='btn btn-detail'>Detail</button>";
                        echo "<button class='btn btn-accept'>Accept</button>";
                        echo "<button class='btn btn-reject'>Reject</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No data available</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
