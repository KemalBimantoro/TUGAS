<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM dosen WHERE id = $id";
        if (mysqli_query($koneksi, $query)) {
            // Jika penghapusan berhasil, arahkan kembali ke halaman index.php
            header("Location: index.php");
            exit; // Penting untuk menghentikan eksekusi skrip setelah mengarahkan halaman
        } else {
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}

mysqli_close($koneksi);
?>
