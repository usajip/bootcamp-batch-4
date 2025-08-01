<?php
include '../../koneksi.php';

// Ambil data produk dari database
$sql = "SELECT * FROM product ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../../navbar_admin.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Tabel Produk</h2>
    <a href="form_input_product.php" class="btn btn-primary mb-3">Tambah Produk</a>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Image</th>
                <th>Description</th>
                <th>Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo $row['stock']; ?></td>
                    <td>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></td>
                    <td>
                        <?php if (!empty($row['image'])) { ?>
                            <img src="../../images/<?php echo htmlspecialchars($row['image']); ?>" alt="Image" width="60">
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?');">Delete</a>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr><td colspan="7" class="text-center">Tidak ada data produk.</td></tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<script src="../bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
