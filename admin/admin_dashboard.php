<?php

@include '../config.php';

// session to check the user login
session_start();

if (!isset($_SESSION['admin_name'])) {
   header('Location: ../index.php');
}


// query to count the number of messages
$sql = "SELECT COUNT(*) AS message_count FROM `user_messages_tbl`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$msgCount = $row['message_count'];


// query to count the number of products
$sql = "SELECT COUNT(*) AS product_count FROM `products_tbl`";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$teacherCount = $row['product_count'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Dashboard</title>

   <!----------------------------------------------------Bootstrap----------------------------------------------------->
   <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../style_sheets/admin_dashboard_styles.css">
   <!-- <link rel="stylesheet" href="../style_sheets/main_form_styles.css"> -->

   <!-- Display a confirmation dialog box -->
   <script>
      function confirmDelete(id) {
         if (confirm("Are You Sure You Want To Delete The Selected Product?")) {
            window.location.href = `delete_product.php?id=${id}`;
         }
      }

      function confirmProductDelete(id) {
         if (confirm("Are You Sure You Want To Delete The Selected Product?")) {
            window.location.href = `delete_product.php?id=${id}`;
         }
      }

      function confirmLogout(id) {
         if (confirm("Are You Sure To logout From Your Account?")) {
            window.location.href = `../logout.php`;
         }
      }

      function confirmMessageDelete(id) {
         if (confirm("Are You Sure To Delete The Selected Message?")) {
            window.location.href = `delete_message.php?id=${id}`;
         }
      }


   </script>

</head>

<body>
   <div class="container">
      <!-- dashboard Navigation -->
      <div class="navigation">
         <ul>
            <li>
               <a href="#">
                  <span class="icon">
                     <img src="../assets/Logo large  version.png" alt="Brand Logo" />
                  </span>
               </a>
            </li>

            <br><br>

            <li data-target="dashboard">
               <a href="#">
                  <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                  <span class="title">Dashboard</span>
               </a>
            </li>

            <li data-target="Teachers">
               <a href="#">
                  <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                  <span class="title">Products</span>
               </a>
            </li>

            <li data-target="Messages">
               <a href="#">
                  <span class="icon"><ion-icon name="chatbubble-outline"></ion-icon></span>
                  <span class="title">Messages</span>
               </a>
            </li>


            <li data-target="Settings">
               <a href="#">
                  <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                  <span class="title">Settings</span>
               </a>
            </li>
         </ul>
      </div>

      <!-- Main Content -->
      <div class="main">
         <div class="topbar">
            <div class="toggle">
               <ion-icon name="menu-outline"></ion-icon>
            </div>
         </div>

         <!-- Dynamic Content -->
         <div class="details">

            <!------------------------------------ Dynamic Content for Dashboard ------------------------------------>
            <div class="dashboard">
               <h2>
                  <ion-icon name="person-outline" class="profileicon"></ion-icon>
                  WELCOME <span><?php echo $_SESSION['admin_name']; ?></span>
               </h2>
               <p>To The Admin Dashboard</p>

               <br><br>
               <!-- Dashboard Summary Cards -->
               <div class="cardBox">
               
                  <div class="card">
                     
                  </div>

                  <div class="card">
                     <div>
                        <div class="numbers"><?= $msgCount ?></div>
                        <div class="cardName">All Messages</div>
                     </div>

                     <div class="iconBx">
                        <ion-icon name="chatbubble-outline"></ion-icon>
                     </div>
                  </div>

                  <div class="card">
                    
                  </div>

                  <div class="card">
                     <div>
                        <div class="numbers"><?= $teacherCount ?></div>
                        <div class="cardName">Available Products</div>
                     </div>

                     <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                     </div>
                  </div>
               </div>


            
            </div>


            <!------------------------------------ Dynamic Content for Products------------------------------------>
            <div class="Teachers">
               <h2>ALL PRODUCTS</h2>
               <p>Manage Your Products Here</p>

               <div class="container">
                  <div class="button-container">
                     <a href="add_product.php" class="add-button-link">
                        <button class="add-button">
                           <ion-icon name="add-sharp" class="addicon"></ion-icon>Add New Product
                        </button>
                     </a>
                  </div>

                  <!-- teachers table -->
                  <div class="table-container">
                     <table class="course-table">
                        <thead>
                           <tr>
                              <th>Product Name</th>
                              <th>Description</th>
                              <th>Price (AUD)</th>
                              <th>Quantity</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>

                           <!-- php to display all teachers -->
                           <?php
                           include "../config.php";
                           $sql = "SELECT * FROM `products_tbl`";
                           $result = mysqli_query($conn, $sql);
                           while ($row = mysqli_fetch_assoc($result)) {
                              ?>
                              <tr>
                                 <td>
                                    <?php echo $row['item_name'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['item_des'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['item_price'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['item_qty'] ?>
                                 </td>
                                 <td>
                                    <a href="update_product.php?id=<?= $row['id'] ?>" class="link-dark"><ion-icon
                                          name="create-sharp" class="editicon"></ion-icon></a>
                                    <a href="javascript:void(0);" onclick="confirmProductDelete(<?= $row['id']; ?>)"
                                       class="link-dark">
                                       <ion-icon name="trash-sharp" class="deleteicon"></ion-icon>
                                    </a>
                                 </td>

                              </tr>
                              <?php
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

            <!------------------------------------ Dynamic Content for Messages ------------------------------------>
            <div class="Messages">
               <h2>ALL MESSAGES</h2>
               <p>Messages and question from users</p>

               <div class="container">
                  <div class="button-container"></div>

                  <!-- inquiries table -->
                  <div class="table-container">
                     <table class="course-table">
                        <thead>
                           <tr>
                              <th>Full Name</th>
                              <th>Contact No</th>
                              <th>Email</th>
                              <th>Message</th>
                              <th>Actions</th>
                           </tr>
                        </thead>
                        <tbody>

                           <!-- php to display all inquiries -->
                           <?php
                           include "../config.php";
                           $sql = "SELECT * FROM `user_messages_tbl`";
                           $result = mysqli_query($conn, $sql);
                           while ($row = mysqli_fetch_assoc($result)) {
                              ?>
                              <tr>
                                 <td>
                                    <?php echo $row['full_name'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['contact_no'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['email'] ?>
                                 </td>
                                 <td>
                                    <?php echo $row['message'] ?>
                                 </td>
                                 <td>
                                    <a href="javascript:void(0);" onclick="confirmMessageDelete(<?= $row['id']; ?>)"
                                       class="link-dark">
                                       <ion-icon name="trash-sharp" class="deleteicon"></ion-icon>
                                    </a>
                                 </td>
                              </tr>
                              <?php
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

            <!------------------------------------ Dynamic Content for Settings ------------------------------------>
            <div class="Settings">

               <div class="Settings_container">

                  <div class="profile-icon">
                     <img src="../assets/profileIcon.png" alt="User Profile">
                  </div>

                  <div class="content">
                     <h3>hi, <span>admin</span></h3>
                     <h1>welcome <span><?php echo $_SESSION['admin_name'] ?></span></h1>
                     <p>this is an admin account</p>
                     <a href="../register_form.php" class="btn">register new admin</a>
                     <a href="javascript:void(0);" class="btn" onclick="confirmLogout()">logout</a>

                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>

   <!-- Scripts -->
   <script src="../js/admin_dashboard.js"></script>

   <!-- Scripts for Free Icons In Ionicons-->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

   <!--Bootstrap-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
</body>

</html>