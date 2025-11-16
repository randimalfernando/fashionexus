<?php
include "../config.php";
$sql = "SELECT * FROM `products_tbl`";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<div class="courses-grid">';
    $counter = 0; 
    while ($row = mysqli_fetch_assoc($result)) {
        if ($counter >= 3) break;
        ?>
        <div class="course-card">
            <div style="height: 200px; overflow: hidden;">
                <img src="../products_pics/<?php echo $row['item_pic']; ?>" alt="Cover Image" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <div style="padding: 15px;  justify-content: center; align-items: center; display: flex; flex-direction: column;">
                <h3 style="font-size: 18px; margin: 0 0 10px;"><?php echo htmlspecialchars($row['item_name']); ?></h3>
                <p style="margin: 0 0 5px;"><?php echo htmlspecialchars($row['item_des']); ?></p>
                <p style="margin: 0 0 5px;"><strong>Price A$</strong> <?php echo htmlspecialchars($row['item_price']); ?></p>
                <p style="margin: 0; color: green;"><strong>Quantity Remaining:</strong> <?php echo htmlspecialchars($row['item_qty']); ?></p>

                <!-- Add to Cart Button (Ionicons) -->
                <form action="home_page.php" method="post" style="margin-top: 15px;">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">

                    <button type="submit" class="add-cart-btn">
                        <ion-icon name="cart-outline"></ion-icon>
                        Add to Cart
                    </button>
                </form>


            </div>
        </div>
        <?php
        $counter++; 
    }
    echo '</div>';
} else {
    echo '<p>No teacher found.</p>';
}
?>
