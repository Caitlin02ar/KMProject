<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Entry Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input,
        .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 0 auto;
            background: #f7f7f7;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            outline: none;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
        }
        .btn {
            display: block;
            width: calc(100% - 20px);
            padding: 12px;
            background: #007bff;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 0 auto;
        }
        .btn:hover {
            background: #0056b3;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <h2>Selamat Datang, Pipel</h2>
    </div>
    <div class="container">
        <h2>Mahasiswa Entry Form</h2>
        <form action="process_mahasiswa.php" method="post">
            <div class="form-group">
                <label for="unit">Unit Akademik/Pendukung</label>
                <select id="unit" name="unit">
                    <option value="Fakultas Teknik">Fakultas Teknik Sipil</option>
                    <option value="Fakultas Teknik">Fakultas Teknologi Industri</option>
                    <option value="Fakultas Teknik">Fakultas Humaniora</option>
                    <option value="Fakultas Teknik">Fakultas SBM</option>
                    <option value="Fakultas Teknik">Fakultas Pendidikan </option>
                    <option value="Fakultas Teknik">Fakultas Kedokteran</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama">Nama Kegiatan</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="tempat">Tempat</label>
                <input type="text" id="tempat" name="tempat" required>
            </div>
            <div class="form-group">
                <label for="periode">Periode</label>
                <select id="periode" name="periode">
                    <option value="1-2023/2024">1-2024/2025</option>
                    <option value="2-2023/2024">2-2024/2025</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="jenis">Jenis Kepanitiaan</label>
                <select id="jenis" name="jenis">
                    <option value="1 tahun">1 tahun</option>
                    <option value="6 bulan">6 bulan</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="lingkup">Lingkup</label>
                <select id="lingkup" name="lingkup">
                    <option value="Internasional">Internasional</option>
                    <option value="Internasional">Regional</option>
                    <option value="Nasional">Nasional</option>
                    <!-- Add other options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon HP</label>
                <input type="text" id="telepon" name="telepon" required>
            </div>
            <button type="submit" class="btn">Tambah</button>
        </form>
    </div>
</body>
</html>
