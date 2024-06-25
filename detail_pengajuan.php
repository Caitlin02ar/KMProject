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
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .box {
            margin-bottom: 15px;
        }
        .label-content {
            font-weight: bold;
        }
        .box-content {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <form action="index.php" class="btn-act">
        <button class="btn btn-danger">Kembali</button>
    </form>
    
    </div>
        <div class="container-detail">
            <h2>Detail Pengajuan SKKK</h2>
        </div>

        <div class="isi-detail">
            <div class="box">
                <div class="label-content">
                    <span>Nama Kegiatan</span>
                </div>
                <div class="box-content">
                    <span><?php echo htmlspecialchars($activity['nama_kegiatan']); ?></span>
                </div>
            </div>

            <div class="box">
                <div class="label-content">
                    <span>Lembaga</span>
                </div>
                <div class="box-content">
                    <span><?php echo htmlspecialchars($activity['lembaga']); ?></span>
                </div>
            </div>
            
            <div class="box">
                <div class="label-content">
                    <span>Periode</span>
                </div>
                <div class="box-content">
                    <span><?php echo htmlspecialchars($activity['periode']); ?></span>
                </div>
            </div>

            <div class="box">
                <div class="label-content">
                    <span>Jenis Kepanitiaan</span>
                </div>
                <div class="box-content">
                    <span><?php echo htmlspecialchars($activity['jenis_kepanitiaan']); ?></span>
                </div>
            </div>

            <div class="box">
                <div class="label-content">
                    <span>Lingkup</span>
                </div>
                <div class="box-content">
                    <span><?php echo htmlspecialchars($activity['lingkup']); ?></span>
                </div>
            </div>

            <div class="box">
                <div class="label-content">
                    <span>File Participant</span>
                </div>
                <div class="box-content">
                    <span><a href="<?php echo htmlspecialchars($activity['file_path']); ?>" target="_blank">Download File</a></span>
                </div>
            </div>

            <div class="box">
                <div class="label-content">
                    <span>Surat Pengajuan</span>
                </div>
                <div class="box-content">
                    <span><a href="<?php echo htmlspecialchars($activity['file_path']); ?>" target="_blank">Download File</a></span>
                </div>
            </div>
        </div>
</body>
</html>
