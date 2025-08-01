<?php
include '../../koneksi.php';

if (!isset($_GET['id'])) {
    echo "Product ID not specified.";
    exit;
}

$id = intval($_GET['id']);

// Get image filename to delete the file later
$result = mysqli_query($conn, "SELECT image FROM product WHERE id = $id");
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];
    // Delete product from database
    $delete = mysqli_query($conn, "DELETE FROM product WHERE id = $id");
    if ($delete) {
        // Delete image file if exists
        if (!empty($image)) {
            $image_path = '../../images/' . $image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        header('Location: tabel_product.php?msg=Product deleted successfully');
        exit;
    } else {
        echo "Failed to delete product: " . mysqli_error($conn);
    }
} else {
    echo "Product not found.";
}
