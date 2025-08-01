<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock = intval($_POST['stock']);
    $price = intval($_POST['price']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Handle image upload
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = '../../images/';
        $img_name = uniqid('img_', true) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $target_file = $target_dir . $img_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array($imageFileType, $allowed_types)) {
            $result = mysqli_query($conn, "SELECT image FROM product WHERE id = $id");
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                if ($row && !empty($row['image'])) {
                    $old_image_path = $target_dir . $row['image'];
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }
            }
            $target_file = $target_dir . $img_name;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $img_name;
            }
        }
    }

    // Get old image if no new image uploaded
    if ($image === '') {
        $result = mysqli_query($conn, "SELECT image FROM product WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
    }

    $query = "UPDATE product SET name='$name', description='$description', stock=$stock, price=$price, image='$image', category='$category' WHERE id=$id";
    if (mysqli_query($conn, $query)) {
        // echo $image ? "Product updated successfully with new image." : "Product updated successfully without new image.";
        header('Location: tabel_product.php?msg=Product updated successfully');
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
