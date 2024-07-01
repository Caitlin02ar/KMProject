<?php
include 'connection.php';

if (!isset($_GET['id'])) {
    die("ID not specified.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM kegiatan WHERE id = ?";
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
$activity = $result->fetch_assoc();
if (!$activity) {
    die("Activity not found.");
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <title>Detail Pengajuan SKKK</title>
    <style>
        th {
            width: 20%;
        }
        td {
            width: 80%;
        }
    </style>
</head>
<body>
    <nav class="navbar box-shadow">
        <div class="container-fluid d-flex align-items-center">
            <span class="navbar-brand mb-0 h1 ms-4">Detail Pengajuan SKKK</span>
            <form action="logout.php" method="post" class="d-flex align-items-center mt-2 mx-4">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </nav>

    <div class="buttons-action px-4">
        <a href="index.php" class="btn btn-danger mt-4">Kembali</a>
    </div>


    <div class="isi-detail">
        <div class="container-detail">
            <h2>Detail Pengajuan SKKK</h2><br>
        </div>

        <table class="table-bordered">
            <tr>
                <th>Nama Kegiatan</th>
                <td><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></td>
            </tr>
            <tr>
                <th>Lembaga</th>
                <td><?php echo htmlspecialchars($activity['lembaga']); ?></td>
            </tr>
            <tr>
                <th>Periode</th>
                <td><?php echo htmlspecialchars($activity['periode']); ?></td>
            </tr>
            <tr>
                <th>Jenis Kepanitiaan</th>
                <td><?php echo htmlspecialchars($activity['jenis_kepanitiaan']); ?></td>
            </tr>
            <tr>
                <th>Lingkup</th>
                <td><?php echo htmlspecialchars($activity['lingkup']); ?></td>
            </tr>
            <tr>
                <th>File Excel Peserta</th>
                <td><a href="<?php echo htmlspecialchars($activity['file_path_excel']); ?>" target="_blank">Download File Excel</a></td>
            </tr>
            <tr>
                <th>File Surat Validasi BEM</th>
                <td><a href="<?php echo htmlspecialchars($activity['file_path_surat']); ?>" target="_blank">Download File Surat</a></td>
            </tr>
            <tr>
                <th>Status BEM</th>
                <td><?php echo htmlspecialchars($activity['status_bem']); ?></td>
            </tr>
            <tr>
                <th>Status BAKA</th>
                <td><?php echo htmlspecialchars($activity['status_baka']); ?></td>
            </tr>
        </table>

        <div class="button-act">
            <button class="btn btn-warning" <?php echo $activity['status_baka'] == 'disetujui' || $activity['status_baka'] == 'diproses' ? 'disabled' : ''; ?>>Revisi Data</button>
            <button class="btn btn-primary" <?php echo $activity['status_baka'] == 'ditolak' || $activity['status_baka'] == 'diproses' ? 'disabled' : ''; ?>>Validasi Data</button>
        </div>
    </div>
</body>

</html>