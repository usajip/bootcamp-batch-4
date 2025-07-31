<?php
// Include koneksi database
include '../koneksi.php';

$error = "";
$name = $stock = $price = $image = $description = $category = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $stock = trim($_POST['stock']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Validasi
    if (empty($name) || empty($stock) || empty($price) || empty($description) || empty($category) || empty($image)) {
        $error = "Semua field harus diisi.";
    } elseif (!is_numeric($stock) || $stock < 0) {
        $error = "Stock harus berupa angka positif.";
    } elseif (!is_numeric($price) || $price < 0) {
        $error = "Price harus berupa angka positif.";
    } else {
        // Upload gambar
        $target_dir = "../images/";
        $target_file = $target_dir . basename($image);
        if (move_uploaded_file($image_tmp, $target_file)) {
            // Kirim data ke query.php
            include 'query.php';
        } else {
            $error = "Gagal upload gambar.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Form Input Product</h2>
    <?php if ($error) { ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>
    <form method="POST" enctype="multipart/form-data" class="row g-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?php echo htmlspecialchars($stock); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="<?php echo htmlspecialchars($price); ?>" required>
        </div>
        <div class="col-md-6">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <div class="col-md-6">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="">Pilih kategori</option>
                <option value="Furniture" <?php if($category=="Furniture") echo "selected"; ?>>Furniture</option>
                <option value="Fashion" <?php if($category=="Fashion") echo "selected"; ?>>Fashion</option>
                <option value="Elektronik" <?php if($category=="Elektronik") echo "selected"; ?>>Elektronik</option>
            </select>
        </div>
        <div class="col-12">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<script src="../bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
