<?php
session_start();
include 'koneksi.php';

// Ambil kategori unik dari database

$category_query = "SELECT DISTINCT category FROM product";
$category_result = mysqli_query($conn, $category_query);

// Ambil kategori yang dipilih dari form (jika ada)

$selected_category = isset($_GET['category']) ? $_GET['category'] : '';

// Handle Add to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $cart_item = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'image' => $_POST['image'],
        'category' => $_POST['category'],
        'qty' => 1
    ];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $cart_item['name']) {
            $item['qty'] += 1;
            $found = true;
            break;
        }
    }
    unset($item);
    if (!$found) {
        $_SESSION['cart'][] = $cart_item;
    }
    // Set session flag for alert
    $_SESSION['cart_success'] = true;
    header('Location: product.php' . ($selected_category ? '?category=' . urlencode($selected_category) : ''));
    exit();
}

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
<?php include 'navbar.php'; ?>
<?php if (!empty($_SESSION['cart_success'])): ?>
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Produk berhasil ditambahkan ke keranjang!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php unset($_SESSION['cart_success']); ?>
<?php endif; ?>
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
                    <form method="post">
                        <input type="hidden" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($row['price']); ?>">
                        <input type="hidden" name="image" value="<?php echo htmlspecialchars($row['image']); ?>">
                        <input type="hidden" name="category" value="<?php echo htmlspecialchars($row['category']); ?>">
                        <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>