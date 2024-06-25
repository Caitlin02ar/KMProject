<?php

include 'connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    echo "Session ID not set. Redirecting to login.";
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$sql = "SELECT nama_lengkap FROM user_table WHERE id = ?";
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
$sql = "SELECT * FROM kegiatan";
$result = $conn->query($sql);
if ($result === false) {
    die("Query failed: " . $conn->error);
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <title>Mahasiswa Dashboard</title>
</head>

<body>
    <nav class="navbar" style="background-color: #F6F1E7;">
        <div class="container-fluid d-flex">
            <span class="navbar-brand mb-0 h1">
                Selamat Datang, <?php echo htmlspecialchars($user['nama_lengkap']); ?>
            </span>

            <form action="logout.php" method="post" class="ms-auto">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="top-banner" style="padding:20px;">
        <div class="alert alert-info" role="alert">
            Mahasiswa dapat menginput data kegiatan untuk pengajuan SKKK Internal
        </div>
    </div>

    <div class="buttons-action px-4">
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </div>

    <div class="container-fluid px-4 table-container mahasiswa">
        <h2>Verifikasi Pengajuan SKKK BEM</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Lembaga</th>
                    <th>Periode</th>
                    <th>Jenis Kepanitiaan</th>
                    <th>Lingkup</th>
                    <th>File Path Surat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama_kegiatan']); ?></td>
                        <td><?php echo htmlspecialchars($row['lembaga']); ?></td>
                        <td><?php echo htmlspecialchars($row['periode']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kepanitiaan']); ?></td>
                        <td><?php echo htmlspecialchars($row['lingkup']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['file_path_surat']); ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="detail_pengajuan.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-info d-flex align-items-center" style="white-space:nowrap;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 16 16">
                                    <path fill="currentColor"
                                        d="m8.93 6.588l-2.29.287l-.082.38l.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319c.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246c-.275 0-.375-.193-.304-.533zM9 4.5a1 1 0 1 1-2 0a1 1 0 0 1 2 0" />
                                </svg>
                                Detail
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>

</html>