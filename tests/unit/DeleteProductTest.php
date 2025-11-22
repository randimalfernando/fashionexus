<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../admin/delete_product.php";

class DeleteProductTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // ✅ Use TEST DB (not fashionexus_db)
        $this->conn = mysqli_connect("localhost", "root", "", "fashionexus_db");

        if (!$this->conn) {
            $this->fail("Test DB connection failed: " . mysqli_connect_error());
        }

        mysqli_query($this->conn, "DELETE FROM products_tbl");
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    private function insertProduct($name, $des, $price, $qty, $pic): int
    {
        mysqli_query(
            $this->conn,
            "INSERT INTO products_tbl(item_name,item_des,item_price,item_qty,item_pic)
             VALUES('$name','$des','$price','$qty','$pic')"
        );
        return mysqli_insert_id($this->conn);
    }

    public function testDeleteProductSuccess()
    {
        $id = $this->insertProduct("Shirt", "Cotton", 20, 5, "shirt.png");

        $result = delete_product($this->conn, $id);

        $this->assertTrue($result["success"]);
        $this->assertEquals("Product deleted successfully.", $result["message"]);

        $check = mysqli_query($this->conn, "SELECT * FROM products_tbl WHERE id=$id");
        $this->assertEquals(0, mysqli_num_rows($check));
    }

    public function testDeleteFailsIfProductNotFound()
    {
        $result = delete_product($this->conn, 99999);

        $this->assertFalse($result["success"]);
        $this->assertContains("Product not found.", $result["errors"]);
    }
}
