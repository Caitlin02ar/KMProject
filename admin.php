<?php

include 'connection.php'; // Ensure this file exists and correctly sets up the $conn variable
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "Session ID not set. Redirecting to login.";
    header("Location: login.php");
    exit();
}

// Fetch user information
$id = $_SESSION['id'];
$sql = "SELECT nama_lengkap, jabatan FROM user_table_table WHERE id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if (!$result) {
    die("Query failed: " . $conn->error);
}
$user = $result->fetch_assoc();
if (!$user) {
    die("User not found.");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="top-bar">
        <div class="welcome-message">
            Welcome, <?php echo htmlspecialchars($user['nama_lengkap']); ?> (<?php echo htmlspecialchars($user['jabatan']); ?>)
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
                    <th>Telepon HP</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_kegiatan->num_rows > 0) {
                    while ($row = $result_kegiatan->fetch_assoc()) {
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