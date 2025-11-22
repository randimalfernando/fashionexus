<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../user/contact_us.php";

class AddUserMessageTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // ⚠️ Use TEST DB (not real DB)
        $this->conn = mysqli_connect("localhost", "root", "", "fashionexus_db");

        if (!$this->conn) {
            $this->fail("DB connection failed: " . mysqli_connect_error());
        }

        mysqli_query($this->conn, "DELETE FROM user_messages_tbl");
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    public function testAddMessageSuccess()
    {
        $post = [
            "full_name"  => "John Doe",
            "contact_no" => "0481202967",
            "email"      => "john@gmail.com",
            "message"    => "I want to know about delivery."
        ];

        $result = add_user_message($this->conn, $post);

        $this->assertTrue($result["success"]);
        $this->assertEquals(
            "Academic staff has received your message and will respond to you shortly.",
            $result["message"]
        );

        $check = mysqli_query(
            $this->conn,
            "SELECT * FROM user_messages_tbl WHERE email='john@gmail.com'"
        );

        $this->assertEquals(1, mysqli_num_rows($check));
    }

    public function testInvalidEmailFails()
    {
        $post = [
            "full_name"  => "Anna",
            "contact_no" => "0481202967",
            "email"      => "invalid-email",
            "message"    => "Help"
        ];

        $result = add_user_message($this->conn, $post);

        $this->assertFalse($result["success"]);
        $this->assertContains("Invalid email address.", $result["errors"]);
    }

    public function testMissingFieldsFail()
    {
        $post = [
            "full_name"  => "",
            "contact_no" => "",
            "email"      => "",
            "message"    => ""
        ];

        $result = add_user_message($this->conn, $post);

        $this->assertFalse($result["success"]);
        $this->assertContains("All fields are required.", $result["errors"]);
    }

    public function testInvalidContactNumberFails()
    {
        $post = [
            "full_name"  => "Michael",
            "contact_no" => "ABCD123",
            "email"      => "mike@gmail.com",
            "message"    => "Question here"
        ];

        $result = add_user_message($this->conn, $post);

        $this->assertFalse($result["success"]);
        $this->assertContains("Invalid contact number.", $result["errors"]);
    }
}
