<?php
$host = "localhost";
$user = "root";
$password = "new_password"; // Ganti dengan password yang sesuai
$database = "bootcamp_db3";

// Buat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
// echo "Koneksi berhasil!";
?>