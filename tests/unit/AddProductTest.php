<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../admin/add_product.php";

class AddProductTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // ✅ Use TEST database (recommended)
        $this->conn = mysqli_connect("localhost", "root", "", "fashionexus_db");
        if (!$this->conn) {
            $this->fail("Test DB connection failed: " . mysqli_connect_error());
        }

        // Clear products table before each test
        mysqli_query($this->conn, "DELETE FROM products_tbl");
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    public function testAddProductSuccess()
    {
        $post = [
            "item_name" => "T-Shirt",
            "item_des" => "Nice cotton shirt",
            "item_price" => "25.50",
            "item_qty" => "10"
        ];

        // Fake image upload (works in testMode)
        $file = [
            "name" => "shirt.png",
            "tmp_name" => "fake_tmp",
            "error" => UPLOAD_ERR_OK
        ];

        $result = add_product($this->conn, $post, $file, true);

        $this->assertTrue($result["success"]);
        $this->assertEquals("New Product Added Successfully", $result["message"]);

        $check = mysqli_query($this->conn, "SELECT * FROM products_tbl WHERE item_name='T-Shirt'");
        $this->assertEquals(1, mysqli_num_rows($check));
    }

    public function testAddProductFailsWithoutImage()
    {
        $post = [
            "item_name" => "Hat",
            "item_des" => "Cool hat",
            "item_price" => "12",
            "item_qty" => "5"
        ];

        $result = add_product($this->conn, $post, null, true);

        $this->assertFalse($result["success"]);
        $this->assertContains("Product image is required.", $result["errors"]);
    }

    public function testAddProductFailsWithInvalidPrice()
    {
        $post = [
            "item_name" => "Shoes",
            "item_des" => "Sport shoes",
            "item_price" => "-10",
            "item_qty" => "3"
        ];

        $file = [
            "name" => "shoes.jpg",
            "tmp_name" => "fake_tmp",
            "error" => UPLOAD_ERR_OK
        ];

        $result = add_product($this->conn, $post, $file, true);

        $this->assertFalse($result["success"]);
        $this->assertContains("Price must be a positive number.", $result["errors"]);
    }
}
