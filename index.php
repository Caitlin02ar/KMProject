<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Mahasiswa Dashboard</h2>
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
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fakultas Sastra</td>
                    <td>Contoh Kegiatan</td>
                    <td>Contoh Tempat</td>
                    <td>1-2023/2024</td>
                    <td>1 tahun</td>
                    <td>Internasional</td>
                    <td>081234567890</td>
                </tr>
                <!-- Additional rows can be added here -->
            </tbody>
        </table>
    </div>
</body>
</html>
