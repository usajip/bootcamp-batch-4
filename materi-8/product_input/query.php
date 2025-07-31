<?php
// Pastikan koneksi sudah tersedia dari include di product.php
if (isset($conn)) {
    // Ambil data dari POST dan variable yang sudah di-set
    $name = isset($name) ? $name : '';
    $stock = isset($stock) ? $stock : '';
    $price = isset($price) ? $price : '';
    $image = isset($image) ? $image : '';
    $description = isset($description) ? $description : '';
    $category = isset($category) ? $category : '';

    // Query insert
    $stmt = $conn->prepare("INSERT INTO product (name, stock, price, image, description, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siisss", $name, $stock, $price, $image, $description, $category);
    if ($stmt->execute()) {
        echo '<div class="alert alert-success mt-3">Data produk berhasil disimpan!</div>';
    } else {
        echo '<div class="alert alert-danger mt-3">Gagal menyimpan data produk: ' . $conn->error . '</div>';
    }
    $stmt->close();
    // $conn->close(); // Jangan close, karena bisa dipakai di halaman lain
}
?>
