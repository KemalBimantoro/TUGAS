<?php
include 'koneksi.php';

// Pastikan form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $matkul = $_POST['matkul'];
    $status = $_POST['status'];

    // Query untuk melakukan update data dosen
    $query = "UPDATE dosen SET nama='$nama', nip='$nip', matkul='$matkul', status='$status' WHERE id=$id";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah proses update berhasil
    if ($result) {
        // Jika berhasil, arahkan kembali ke halaman index.php
        header("Location: index.php");
        exit; // Penting untuk menghentikan eksekusi skrip setelah mengarahkan halaman
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Tutup koneksi
    mysqli_close($koneksi);
}

// Ambil data dosen yang akan di-edit berdasarkan id
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data dosen berdasarkan id
    $query = "SELECT * FROM dosen WHERE id=$id";
    $result = mysqli_query($koneksi, $query);

    // Pastikan data dosen dengan id tersebut ada
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $nama = $row['nama'];
        $nip = $row['nip'];
        $matkul = $row['matkul'];
        $status = $row['status'];
    } else {
        echo "Data dosen tidak ditemukan.";
        exit;
    }

    // Bebaskan memori dari result set
    mysqli_free_result($result);
} else {
    echo "ID dosen tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistem Informasi Akademik - Edit Data Dosen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 4px;
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
            border: 1px solid #ccc;
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
    </style>
</head>
<body>
    <h1>Edit Data Dosen</h1>

    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="nama">Nama Dosen:</label>
        <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>

        <label for="nip">NIP:</label>
        <input type="number" id="nip" name="nip" value="<?php echo $nip; ?>" required>

        <label for="matkul">Mata Kuliah:</label>
        <input type="text" id="matkul" name="matkul" value="<?php echo $matkul; ?>" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Tetap" <?php if ($status === 'tetap') echo 'selected'; ?>>Tetap</option>
            <option value="Magang" <?php if ($status === 'magang') echo 'selected'; ?>>Magang</option>
        </select>

        <input type="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
