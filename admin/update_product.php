<?php

@include '../config.php';

// session to check the user login
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('Location: ../index.php');
    exit();
}

// to store the selected id
$id = isset($_GET['id']) ? $_GET['id'] : '';

$message = '';

if (isset($_POST["submit"])) {
    $id         = $_POST['id'];
    $item_name  = $_POST['item_name'];
    $item_des   = $_POST['item_des'];
    $item_price = $_POST['item_price'];
    $item_qty   = $_POST['item_qty'];

    // First, get existing product to keep current image if no new one uploaded
    $item_pic = '';
    $productQuery  = "SELECT `item_pic` FROM `products_tbl` WHERE `id` = '$id'";
    $productResult = mysqli_query($conn, $productQuery);

    if ($productResult && mysqli_num_rows($productResult) > 0) {
        $row      = mysqli_fetch_assoc($productResult);
        $item_pic = $row['item_pic']; // existing picture
    }

    // Target directory for product pictures (same as add function)
    $targetDir = __DIR__ . "/../products_pics/";

    // Ensure the directory exists
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Handle file upload 
    if (isset($_FILES['item_pic']) && $_FILES['item_pic']['error'] === UPLOAD_ERR_OK) {
        $targetFile = $targetDir . basename($_FILES['item_pic']['name']);
        if (move_uploaded_file($_FILES['item_pic']['tmp_name'], $targetFile)) {
            $item_pic = basename($_FILES['item_pic']['name']); // Save only file name for the database
        } else {
            $message = "Failed to move uploaded file.";
        }
    }

    // Update query
    $sql = "UPDATE `products_tbl` 
            SET `item_name` = '$item_name', 
                `item_des` = '$item_des', 
                `item_price` = '$item_price', 
                `item_qty` = '$item_qty', 
                `item_pic` = '$item_pic'
            WHERE `id` = '$id'";

    if (mysqli_query($conn, $sql)) {
        $message = "Product Updated Successfully";
    } else {
        $message = "Failed: " . mysqli_error($conn);
    }
}

// Fetch teacher data for the selected teacher ID
$sql = "SELECT * FROM `products_tbl` WHERE `id` = '$id' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/admin_main_form_styles.css">
</head>

<body>
    <div class="navbar">UPDATE THE SELECTED TEACHER</div>

    <div class="form_container">

        <!-- Display status message -->
        <?php if ($message): ?>
            <div class="message-box <?= strpos($message, 'Successfully') !== false ? 'success' : 'error' ?>">
                <?= $message ?>
            </div>
            <?php if (strpos($message, 'Successfully') !== false): ?>
                <!-- Script to stay on the page for 2 minutes and direct back to dashboard -->
                <script>
                    setTimeout(() => {
                        window.location.href = "admin_dashboard.php";
                    }, 2000);
                </script>
            <?php endif; ?>
        <?php endif; ?>

        <!-- Update product form -->
        <form action="update_product.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" value="<?= $row['item_name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="item_des">Description:</label>
                <input type="text" name="item_des" id="item_des" value="<?= $row['item_des'] ?>" required>
            </div>

            <div class="form-group">
                <label for="item_price">Price:</label>
                <input type="text" name="item_price" id="item_price" value="<?= $row['item_price'] ?>" required>
            </div>

            <div class="form-group">
                <label for="item_qty">Quantity:</label>
                 <input type="text" name="item_qty" id="item_qty" value="<?= $row['item_qty'] ?>" required>
            </div>

            <div class="form-group">
                <label for="item_pic">Product Picture:</label>
                <?php if (!empty($row['item_pic'])): ?>
                    <img src="../products_pics/<?= htmlspecialchars($row['item_pic']) ?>"
                        alt="Product Picture" width="100">
                <?php endif; ?>
                <br>
                <!-- Not required on update (keeps old image if empty) -->
                <input type="file" name="item_pic" id="item_pic" accept=".jpg, .jpeg, .png">
            </div>

            <!-- Hidden ID for update -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">

            <div class="button-group">
                <button type="submit" class="btn-success" name="submit">Update Product</button>
                <a href="admin_dashboard.php" class="btn-danger">Cancel</a>
            </div>
        </form>

    </div>
</body>

</html>