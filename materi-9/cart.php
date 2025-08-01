<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Handle update quantity
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_qty']) && isset($_POST['index']) && isset($_POST['qty'])) {
        $idx = (int)$_POST['index'];
        $qty = max(1, (int)$_POST['qty']);
        if (isset($_SESSION['cart'][$idx])) {
            $_SESSION['cart'][$idx]['qty'] = $qty;
        }
        $_SESSION['cart_alert'] = 'update';
        header('Location: cart.php');
        exit();
    }
    if (isset($_POST['delete_item']) && isset($_POST['index'])) {
        $idx = (int)$_POST['index'];
        if (isset($_SESSION['cart'][$idx])) {
            array_splice($_SESSION['cart'], $idx, 1);
        }
        $_SESSION['cart_alert'] = 'delete';
        header('Location: cart.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Keranjang Belanja</h2>
    <a href="product.php" class="btn btn-secondary mb-3">Kembali ke Produk</a>
    <?php if (!empty($_SESSION['cart_alert'])): ?>
        <?php if ($_SESSION['cart_alert'] === 'update'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Jumlah produk berhasil diubah!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php elseif ($_SESSION['cart_alert'] === 'delete'): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Produk berhasil dihapus dari keranjang!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; unset($_SESSION['cart_alert']); ?>
    <?php endif; ?>
    <?php if (empty($cart)): ?>
        <div class="alert alert-info">Keranjang belanja kosong.</div>
    <?php else: ?>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($cart as $i => $item): ?>
                <tr>
                    <td><img src="images/<?php echo htmlspecialchars($item['image']); ?>" width="60"></td>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['category']); ?></td>
                    <td>Rp<?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                    <td>
                        <form method="post" class="d-flex align-items-center" style="gap:4px;">
                            <input type="hidden" name="index" value="<?php echo $i; ?>">
                            <input type="number" name="qty" value="<?php echo $item['qty']; ?>" min="1" class="form-control form-control-sm" style="width:70px;display:inline-block;">
                            <button type="submit" name="update_qty" class="btn btn-sm btn-warning">Update</button>
                        </form>
                    </td>
                    <td>Rp<?php echo number_format($item['price'] * $item['qty'], 0, ',', '.'); ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Hapus produk ini dari keranjang?');">
                            <input type="hidden" name="index" value="<?php echo $i; ?>">
                            <button type="submit" name="delete_item" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $item['price'] * $item['qty']; ?>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="6" class="text-end">Total</th>
                <th>Rp<?php echo number_format($total, 0, ',', '.'); ?></th>
            </tr>
        </tfoot>
    </table>
    <a href="checkout.php" class="btn btn-success mb-3">Checkout</a>
    <?php endif; ?>
</div>
</body>
</html>
