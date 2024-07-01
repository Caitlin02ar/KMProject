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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $lembaga = $_POST['lembaga'];
    $periode = $_POST['periode'];
    $jenis = $_POST['jenis'];
    $lingkup = $_POST['lingkup'];

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["excel"]["name"]);
    if (move_uploaded_file($_FILES["excel"]["tmp_name"], $target_file)) {
        $file_path_excel = $target_file;
        $file_path_surat = "uploads/contoh_surat.docx"; // Predefined file path for the surat

        // Insert data into the database using prepared statements
        $sql = "INSERT INTO kegiatan (nama_kegiatan, lembaga, periode, jenis_kepanitiaan, lingkup, file_path_excel, file_path_surat, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, 'diproses')";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("sssssss", $nama, $lembaga, $periode, $jenis, $lingkup, $file_path_excel, $file_path_surat);
        if ($stmt->execute()) {
            echo "<script>
                    alert('Data kegiatan berhasil ditambahkan');
                    window.location.href = 'index.php';
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
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
    <title>Mahasiswa Entry Form</title>
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

    <div class="buttons-action px-4 ms-4 mt-4">
        <a href="index.php" class="btn btn-danger">Kembali</a>
    </div>

    <div class="container-box">
        <div class="container">
            <h2>Mahasiswa Entry Form</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nama">Nama Kegiatan</label>
                            <input type="text" id="nama" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="lembaga">Lembaga</label>
                            <select name="lembaga" id="lembaga" class="form-control">
                                <option value="BEM">BEM</option>
                                <option value="MPM">MPM</option>
                                <option value="Persma">Persma</option>
                                <option value="BPMF">BPMF</option>
                                <option value="PPS">PPS</option>
                                <option value="Pelma">Pelma</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="periode">Periode</label>
                            <select id="periode" name="periode" class="form-control">
                                <option value="1-2024/2025">1-2024/2025</option>
                                <option value="2-2024/2025">2-2024/2025</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Kepanitiaan</label>
                            <select id="jenis" name="jenis" class="form-control">
                                <option value="1 tahun">1 tahun</option>
                                <option value="6 bulan">6 bulan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lingkup">Lingkup</label>
                            <select id="lingkup" name="lingkup" class="form-control">
                                <option value="Internasional">Internasional</option>
                                <option value="Regional">Regional</option>
                                <option value="Nasional">Nasional</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="excel">Upload Excel</label>
                            <input type="file" id="excel" name="excel" class="form-control pl-2" accept=".xls,.xlsx" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary d-flex text-align-end ms-2">Tambah</button>
            </form>
        </div>
    </div>
</body>

</html>