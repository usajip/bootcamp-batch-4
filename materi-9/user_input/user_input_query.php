<?php

include '../koneksi.php';

$name = $email = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    // Validasi nama
    if (empty($name)) {
        $errors[] = 'Nama wajib diisi.';
    } elseif (strlen($name) < 3) {
        $errors[] = 'Nama minimal 3 karakter.';
    }

    // Validasi email
    if (empty($email)) {
        $errors[] = 'Email wajib diisi.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    }

    if (empty($errors)) {
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);

        $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        if (mysqli_query($conn, $query)) {
            echo '<div class="alert alert-success">Data berhasil disimpan.</div>';
            $name = $email = '';
        } else {
            echo '<div class="alert alert-danger">Gagal menyimpan data.</div>';
        }
    } else {
        foreach ($errors as $error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    }
}
?>