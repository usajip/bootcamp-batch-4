<?php
session_start();
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
if (empty($cart)) {
    header('Location: cart.php');
    exit();
}
// WhatsApp number tujuan (ganti dengan nomor admin/penjual)
$wa_number = '6281234567890'; // format: 62xxxxxxxxxxx

function make_wa_text($cart, $nama, $hp, $alamat) {
    $text = "*Order Baru*\n";
    $text .= "Nama: $nama\n";
    $text .= "No HP: $hp\n";
    $text .= "Alamat: $alamat\n";
    $text .= "\n*Daftar Produk:*\n";
    $total = 0;
    foreach ($cart as $item) {
        $text .= "- {$item['name']} ({$item['qty']} x Rp".number_format($item['price'],0,',','.').") = Rp".number_format($item['price']*$item['qty'],0,',','.')."\n";
        $total += $item['price'] * $item['qty'];
    }
    $text .= "\nTotal: Rp".number_format($total,0,',','.');
    return $text;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $hp = trim($_POST['hp'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    if ($nama && $hp && $alamat) {
        $wa_text = make_wa_text($cart, $nama, $hp, $alamat);
        $wa_url = 'https://wa.me/' . $wa_number . '?text=' . urlencode($wa_text);
        header('Location: ' . $wa_url);
        exit();
    } else {
        $error = 'Semua field harus diisi.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container mt-5">
    <h2 class="mb-4">Checkout</h2>
    <a href="cart.php" class="btn btn-secondary mb-3">Kembali ke Keranjang</a>
    <div class="row">
        <div class="col-md-6">
            <h5>Informasi Produk</h5>
            <ul class="list-group mb-3">
                <?php $total = 0; foreach ($cart as $item): $total += $item['price']*$item['qty']; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo htmlspecialchars($item['name']); ?> (<?php echo $item['qty']; ?> x Rp<?php echo number_format($item['price'],0,',','.'); ?>)
                    <span>Rp<?php echo number_format($item['price']*$item['qty'],0,',','.'); ?></span>
                </li>
                <?php endforeach; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                    Total
                    <span>Rp<?php echo number_format($total,0,',','.'); ?></span>
                </li>
            </ul>
        </div>
        <div class="col-md-6">
            <h5>Data Customer</h5>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="post">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="mb-3">
                    <label for="hp" class="form-label">No HP</label>
                    <input type="text" class="form-control" id="hp" name="hp" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Kirim ke WhatsApp</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
