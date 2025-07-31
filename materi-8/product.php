<?php
include 'koneksi.php';

// Ambil kategori unik dari database
$category_query = "SELECT DISTINCT category FROM product";
$category_result = mysqli_query($conn, $category_query);

// Ambil kategori yang dipilih dari form (jika ada)
$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

// Query produk, filter jika kategori dipilih
if ($selected_category) {
    $query = "SELECT name, stock, price, image, description, category FROM product WHERE category = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $selected_category);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    $query = "SELECT name, stock, price, image, description, category FROM product";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Daftar Produk</h2>
    <!-- Filter Form -->
    <form method="get" class="mb-4">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua Kategori</option>
                    <?php while($cat = mysqli_fetch_assoc($category_result)): ?>
                        <option value="<?php echo htmlspecialchars($cat['category']); ?>" <?php if($selected_category == $cat['category']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($cat['category']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
    </form>
    <div class="row">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <ul class="list-group list-group-flush mb-2">
                        <li class="list-group-item">Kategori: <?php echo htmlspecialchars($row['category']); ?></li>
                        <li class="list-group-item">Stok: <?php echo htmlspecialchars($row['stock']); ?></li>
                        <li class="list-group-item">Harga: Rp<?php echo number_format($row['price'], 0, ',', '.'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>