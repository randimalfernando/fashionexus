<?php

@include '../config.php';

// session to check the user login
session_start();

if (!isset($_SESSION['admin_name'])) {
   header('Location: ../index.php');
}

// php function to add new product
$message = "";

if (isset($_POST["submit"])) {
    $item_name = $_POST['item_name'];
    $item_des = $_POST['item_des'];
    $item_price = $_POST['item_price'];
    $item_qty = $_POST['item_qty'];

    // Initialize product picture
    $item_pic = '';

     // Target directory for product picturs
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
            // $message = "File uploaded successfully.";
        } else {
            $message = "Failed to move uploaded file.";
        }
    } else {
        $message = "File upload error: " . ($_FILES['item_pic']['error'] ?? 'No file uploaded.');
    }


    // insert query with the product name
    $sql = "INSERT INTO `products_tbl`(`id`, `item_name`, `item_des`, `item_price`, `item_qty`, `item_pic`) 
            VALUES (NULL, '$item_name', '$item_des', '$item_price', '$item_qty', '$item_pic')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "New Product Added Successfully";
    } else {
        $message = "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/admin_main_form_styles.css">
</head>

<body>
    <div class="navbar">ADD NEW PRODUCT</div>

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

        <!-- Add new product form -->
        <form action="add_product.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="item_name">Item Name:</label>
                <input type="text" name="item_name" id="item_name" placeholder="Enter Product Name" required>
            </div>

            <div class="form-group">
                <label for="item_des">Description:</label>
                <input type="text" name="item_des" id="item_des" placeholder="Enter Product Description" required>
            </div>

            <div class="form-group">
                <label for="item_price">Price:</label>
                <input type="text" name="item_price" id="item_price" placeholder="Enter Price Per Unit" required>
            </div>

            <div class="form-group">
                <label for="item_qty">Quantity:</label>
                <input type="text" name="item_qty" id="item_qty" placeholder="Enter Quantity" required>
            </div>

            <div class="form-group">
                <label for="item_pic">Product Picture:</label>
                <input type="file" name="item_pic" id="item_pic" accept=".jpg, .jpeg, .png" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-success" name="submit">Add Product</button>
                <a href="admin_dashboard.php" class="btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
