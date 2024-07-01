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
    <nav class="navbar box-shadow" style="background-color: #007bff;">
        <div class="container-fluid d-flex align-items-center">
            <span class="navbar-brand mb-0 h1 ms-4 text-light">
                Selamat Datang, <?php echo htmlspecialchars(ucwords($user['nama_lengkap'])); ?>
            </span>
            <form action="logout.php" method="post" class="d-flex align-items-center mt-2 mx-4">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="top-banner" style="padding:20px;">
        <div class="alert alert-info br-10 box-shadow" role="alert">
            Mahasiswa dapat menginput data kegiatan untuk pengajuan SKKK Kegiatan
        </div>
    </div>

    <div class="buttons-action ms-4">
        <a href="verifikasi_BEM.php" class="btn btn-primary br-10">Verifikasi Pengajuan SKKK (Ke BEM)</a>
        <a href="verifikasi_BAKA.php" class="btn btn-primary br-10">Validasi Data (Ke BAKA)</a>
    </div>

    <div class="container-fluid table-container mahasiswa">
        <h2>Mahasiswa Dashboard</h2>
        <a href="input_data.php" class="btn btn-primary br-10">Tambah Kegiatan</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Kegiatan</th>
                    <th>Lembaga</th>
                    <th>Periode</th>
                    <th>Jenis Kepanitiaan</th>
                    <th>Lingkup</th>
                    <th>File Path Excel</th>
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
                        <td><a href="<?php echo htmlspecialchars($row['file_path_excel']); ?>" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="detail_pengajuan.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-primary d-flex align-items-center justify-content-center light-blue">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1.5em" viewBox="0 0 16 16">
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