<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = trim($_POST["nama"]);
    $deskripsi = trim($_POST["deskripsi"]);
    $harga = $_POST["harga"];
    $kategori = $_POST["kategori"];

    // Validasi sederhana
    $errors = [];

    if (empty($nama) || strlen($nama) < 3) {
        $errors[] = "Nama produk wajib diisi.";
    }

    if (empty($deskripsi)) {
        $errors[] = "Deskripsi wajib diisi.";
    }

    if (!is_numeric($harga) || $harga <= 0) {
        $errors[] = "Harga harus berupa angka lebih dari 0.";
    }

    if (empty($kategori)) {
        $errors[] = "Kategori wajib dipilih.";
    }

    // Tampilkan hasil atau error
    if (count($errors) > 0) {
        echo "<h3>Terjadi Kesalahan:</h3><ul>";
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul><a href='javascript:history.back()'>Kembali</a>";
    } else {
        // Simpan ke database di sini (simulasi saja)
        echo "<h3>Data Produk Berhasil Disimpan</h3>";
        echo "<p><strong>Nama:</strong> " . htmlspecialchars($nama) . "</p>";
        echo "<p><strong>Deskripsi:</strong> " . htmlspecialchars($deskripsi) . "</p>";
        echo "<p><strong>Harga:</strong> Rp " . number_format($harga, 0, ',', '.') . "</p>";
        echo "<p><strong>Kategori:</strong> " . htmlspecialchars($kategori) . "</p>";
    }
} else {
    echo "Akses tidak valid.";
}
?>