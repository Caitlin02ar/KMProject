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
$sql = "SELECT nama_lengkap, jabatan FROM user_table WHERE id = ?";
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

// Fetch the data to display in the table
$sql_kegiatan = "SELECT * FROM kegiatan";
$result_kegiatan = $conn->query($sql_kegiatan);
if ($result_kegiatan === false) {
    die("Query failed: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7MU5L5sI5Tfnv2FZq4x0p5bF5dyIs6qrD6g"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="top-bar">
        <div class="welcome-message">
            Welcome, <?php echo htmlspecialchars($user['nama_lengkap']); ?>
            (<?php echo htmlspecialchars($user['jabatan']); ?>)
        </div>
        <form action="logout.php" method="post">
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Lembaga</th>
                    <th>Periode</th>
                    <th>Jenis Kepanitiaan</th>
                    <th>Lingkup</th>
                    <th>File Path Excel</th>
                    <th>File Path Surat</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_kegiatan->num_rows > 0) {
                    while ($row = $result_kegiatan->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["nama_kegiatan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lembaga"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["periode"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jenis_kepanitiaan"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["lingkup"]) . "</td>";
                        echo "<td><a href='" . htmlspecialchars($row["file_path_excel"]) . "' target='_blank'>Download</a></td>";
                        echo "<td><a href='" . htmlspecialchars($row["file_path_surat"]) . "' target='_blank'>Download</a></td>";
                        echo "<td class='status'>" . htmlspecialchars($row["status"]) . "</td>";
                        echo "<td class='action-buttons'>";
                        echo "<a href='detail_admin.php?id=" . $row['id'] . "' class='btn btn-detail'>Detail</a>";
                        echo "<form action='update_status.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='status' value='disetujui'>";
                        echo "<button type='submit' class='btn btn-accept'>Accept</button>";
                        echo "</form>";
                        echo "<form action='update_status.php' method='post' style='display:inline;'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='status' value='ditolak'>";
                        echo "<button type='submit' class='btn btn-reject'>Reject</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No data available</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>