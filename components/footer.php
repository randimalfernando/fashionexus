<!-- website footer -->
<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive footer</title>
    <style>
        /* CSS styles for footer */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        footer {
            width: 100%;
            position: inherit;
            bottom: 0;
            background: linear-gradient(to right, #00093c, #2d0b00);
            color: #fff;
            padding: 20px 0 10px;
            font-size: 13px;
            line-height: 20px;
        }

        .col .logo {
            width: 200px;
            height: 150px;
        }

        .row {
            width: 85%;
            margin: auto;
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
        }

        .col {
            flex-basis: 2%;
            padding: 10px;

        }

        .logo {
            width: 100px;
            margin-bottom: 20px;
        }

        .col:nth-child(2),
        .col:nth-child(3) {
            flex-basis: 15%;
        }

        .col h3 {
            width: fit-content;
            margin-bottom: 40px;
            position: relative;
        }

        .email {
            width: fit-content;
            margin: 20px 0;

        }

        ul li {
            list-style: none;
            margin-bottom: 12px;
        }

        ul li a {
            text-decoration: none;
            color: #fff;

        }

        ul .sMedia {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            text-align: center;
            line-height: 20px;
            font-size: 20px;
            color: #fff;
            margin-right: 15px;
            cursor: pointer;
        }

        hr {
            width: 90%;
            border: 0;
            border-bottom: 1px solid #ccc;
            margin: 20px auto;
        }

        .copyRight {
            text-align: center;
        }

        @media(max-width:700px) {
            footer {
                bottom: unset;
            }

            .col {
                flex-basis: 100%;

            }


            .col:nth-child(2),
            .col:nth-child(3) {
                flex-basis: 100%;
            }
        }

    </style>
</head>

<body>
    <!-- footer  -->
    <footer>
        <div class="row">

            <div class="col">
                <img src="../assets/Logo large  version.png"  class="logo">
                <p>
                    <center>Discover your style</center>
                </p>
            </div>

            <div class="col">
                <h3>LOCATION</h3>
                <p>Queen St,</p>
                <p>Melbourne,</p>
                <p>Victoria</p>
                <p class="email">contact@fashionnexus.com</p>
                <h4>0481202967</h4>
            </div>

            <div class="col">
                <h3>QUICK LINKS</h3>
                <ul>
                    <li><a href="home_page.php">Home</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="cart.php">My Cart</a></li>
                </ul>
            </div>

            <div class="col">
                <h3>EXPLORE</h3>
                <ul>
                    <li><a href="about_us.php">About Us</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                </ul>
            </div>

        </div>
        <hr>
        <p class="copyRight">Copyright © 2025 Group Melbourne 03</p>
    </footer>

</body>

</html>