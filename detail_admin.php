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
        .container-detail {
            text-align: center;
            margin-top: 20px;
        }

        .isi-detail {
            margin: 20px;        
        }

        .form-group {
            margin-bottom: 15px;
        }

        .button-act {
            text-align: center;
            margin-top: 20px;
        }

        .button-act button {
            margin-right: 10px;
        }

        .download-button {
            width: auto;
            display: inline-block;
            text-align: center;
            /* padding: 8px 12px; */
            /* margin-top: 5px; */
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container-detail">
        <h2>Detail Pengajuan SKKK</h2>
        <form action="admin.php" class="btn-act mt-3">
            <button class="btn btn-danger">Kembali</button>
        </form>
    </div>

    <div class="container">
        <form class="isi-detail">
            <div class="form-group">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" id="nama_kegiatan" class="form-control" value="<?php echo htmlspecialchars($activity['nama_kegiatan']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="lembaga" class="form-label">Lembaga</label>
                <input type="text" id="lembaga" class="form-control" value="<?php echo htmlspecialchars($activity['lembaga']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="periode" class="form-label">Periode</label>
                <input type="text" id="periode" class="form-control" value="<?php echo htmlspecialchars($activity['periode']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="jenis_kepanitiaan" class="form-label">Jenis Kepanitiaan</label>
                <input type="text" id="jenis_kepanitiaan" class="form-control" value="<?php echo htmlspecialchars($activity['jenis_kepanitiaan']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="lingkup" class="form-label">Lingkup</label>
                <input type="text" id="lingkup" class="form-control" value="<?php echo htmlspecialchars($activity['lingkup']); ?>" disabled>
            </div>

            <div class="form-group">
                <label for="file_path_excel" class="form-label">File Excel Peserta</label>
                <a href="<?php echo htmlspecialchars($activity['file_path_excel']); ?>" target="_blank" class="btn btn-info download-button">Download File Excel</a>
            </div>

            <div class="form-group">
                <label for="file_path_surat" class="form-label">File Surat Validasi BEM</label>
                <a href="<?php echo htmlspecialchars($activity['file_path_surat']); ?>" target="_blank" class="btn btn-info download-button">Download File Surat</a>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <input type="text" id="status" class="form-control" value="<?php echo htmlspecialchars($activity['status_baka']); ?>" disabled>
            </div>

            <div class="button-act mt-3">
                <button class="btn btn-warning" <?php echo $activity['status_baka'] == 'disetujui' || $activity['status_baka'] == 'diproses' ? 'disabled' : ''; ?>>Revisi Data</button>
                <button class="btn btn-primary" <?php echo $activity['status_baka'] == 'ditolak' || $activity['status_baka'] == 'diproses' ? 'disabled' : ''; ?>>Validasi Data</button>
            </div>
        </form>
    </div>
</body>

</html>
