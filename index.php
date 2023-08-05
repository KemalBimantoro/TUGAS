<!DOCTYPE html>
<html>
<head>
    <title>sistem infomasi akademik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin: 20px;
        }

        .form-container {
            flex: 1;
            margin-right: 20px;
            border: 2px solid #ccc;
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 2px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            height: 36px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
        .action-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 5px;
        }

        .action-buttons button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
        }

        .action-buttons a.edit {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .action-buttons a.edit:hover {
            background-color: #0056b3;
        }

       
        .action-buttons form {
            display: flex;
        }

        .action-buttons form button.delete {
            flex: 1;
            padding: 6px 12px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-left: 5px;
        }

        .action-buttons form button.delete:hover {
            background-color: #b02a37;
        }
    </style>
</head>
<body>
    <div class="container">
    
        <div class="form-container">
            <h1>Form Input Data Dosen Akademik</h1>
            <form action="simpan_dosen.php" method="post">
                <label for="nama">Nama Dosen:</label>
                <input type="text" id="nama" name="nama" required>

                <label for="nip">NIP:</label>
                <input type="number" id="nip" name="nip" required>

                <label for="matkul">Mata Kuliah:</label>
                <input type="text" id="matkul" name="matkul" required>

                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="tetap">Tetap</option>
                    <option value="magang">Magang</option>
                </select>

                <input type="submit" value="Simpan">
            </form>
        </div>

    
        <div class="table-container">
            <h1>Data Dosen Akademik</h1>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nama Dosen</th>
                    <th>NIP</th>
                    <th>Mata Kuliah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                ini_set('display_errors', 1);
                error_reporting(E_ALL);
                include 'koneksi.php';
                
                $query = "SELECT * FROM buku";
                $result = mysqli_query($koneksi, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['nama'] . '</td>';
                    echo '<td>' . $row['nip'] . '</td>';
                    echo '<td>' . $row['matkul'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td class="action-buttons">';
                    echo '<a href="edit.php?id=' . $row['id'] . '" class="edit">Edit</a>';
                    echo '<form action="hapus.php" method="post" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">';
                    echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                    echo '<button type="submit" class="delete">Hapus</button>';
                    echo '</form>';
                    echo '</td>';
                    echo '</tr>';
                }

                if (mysqli_num_rows($result) === 0) {
                    echo '<tr><td colspan="6">Tidak ada data dosen.</td></tr>';
                }

                mysqli_free_result($result);

                mysqli_close($koneksi);
                ?>
            </table>
        </div>
    </div>
</body>
</html>
