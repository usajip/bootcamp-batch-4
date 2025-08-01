<?php
include '../../koneksi.php';

if (!isset($_GET['id'])) {
    echo "Product ID not specified.";
    exit;
}

$id = intval($_GET['id']);
$query = "SELECT * FROM product WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Product not found.";
    exit;
}

$product = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../navbar_admin.php'; ?>
<div class="container mt-5">
    <h2>Edit Product</h2>
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($product['name']); ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" required value="<?php echo $product['stock']; ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" min="0" step="1000" required value="<?php echo $product['price']; ?>">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($product['image'])): ?>
                <img src="../../images/<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" width="120" class="mt-2">
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category" required>
                <option value="">Select Category</option>
                <option value="Elektronik" <?php if($product['category'] == 'Elektronik') echo 'selected'; ?>>Elektronik</option>
                <option value="Furniture" <?php if($product['category'] == 'Furniture') echo 'selected'; ?>>Furniture</option>
                <option value="Fashion" <?php if($product['category'] == 'Fashion') echo 'selected'; ?>>Fashion</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
</body>
</html>