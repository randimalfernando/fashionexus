<!-- Database connection and error handling -->
<?php
$servername="localhost";
$username="root";
$password="";
$dbname="fashionexus_db";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Connection to db failed:".mysqli_connect_error());
}
