<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../admin/update_product.php";

class UpdateProductTest extends TestCase
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

    public function testUpdateKeepsOldImageWhenNoNewImage()
    {
        $id = $this->insertProduct("Old Shirt", "Old desc", 20, 5, "old.png");

        $post = [
            "id" => $id,
            "item_name" => "New Shirt",
            "item_des" => "New desc",
            "item_price" => "30",
            "item_qty" => "8"
        ];

        $result = update_product($this->conn, $post, null, true);

        $this->assertTrue($result["success"]);
        $this->assertEquals("Product Updated Successfully", $result["message"]);

        $check = mysqli_query($this->conn, "SELECT * FROM products_tbl WHERE id=$id");
        $row = mysqli_fetch_assoc($check);

        $this->assertEquals("New Shirt", $row["item_name"]);
        $this->assertEquals("old.png", $row["item_pic"]); // image unchanged
    }

    public function testUpdateReplacesImageWhenNewImageGiven()
    {
        $id = $this->insertProduct("Hat", "Nice hat", 10, 2, "hat_old.jpg");

        $post = [
            "id" => $id,
            "item_name" => "Hat Updated",
            "item_des" => "Updated desc",
            "item_price" => "15",
            "item_qty" => "4"
        ];

        $file = [
            "name" => "hat_new.png",
            "tmp_name" => "fake_tmp",
            "error" => UPLOAD_ERR_OK
        ];

        $result = update_product($this->conn, $post, $file, true);

        $this->assertTrue($result["success"]);

        $check = mysqli_query($this->conn, "SELECT item_pic FROM products_tbl WHERE id=$id");
        $row = mysqli_fetch_assoc($check);

        $this->assertEquals("hat_new.png", $row["item_pic"]);
    }

    public function testUpdateFailsWithInvalidPrice()
    {
        $id = $this->insertProduct("Shoes", "Running shoes", 50, 3, "shoe.png");

        $post = [
            "id" => $id,
            "item_name" => "Shoes",
            "item_des" => "Running shoes",
            "item_price" => "-5",
            "item_qty" => "3"
        ];

        $result = update_product($this->conn, $post, null, true);

        $this->assertFalse($result["success"]);
        $this->assertContains("Price must be a positive number.", $result["errors"]);
    }
}
