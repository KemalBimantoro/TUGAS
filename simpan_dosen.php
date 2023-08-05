<?php
include 'koneksi.php';

// Pastikan form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $matkul = $_POST['matkul'];
    $status = $_POST['status'];

    // Query untuk menyimpan data dosen ke database
    $query = "INSERT INTO dosen (nama, nip, matkul, status) VALUES ('$nama', '$nip', $matkul, '$status')";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah penyimpanan data berhasil
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
?>
