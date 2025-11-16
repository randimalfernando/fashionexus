<!-- php function to delete a message  -->
<?php
    include "../config.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM `user_messages_tbl` WHERE id=$id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location: admin_dashboard.php");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
?>
