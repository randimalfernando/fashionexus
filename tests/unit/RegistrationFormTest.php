<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../register_form.php";

class RegisterFormTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        // ✅ connect to a TEST database (important!)
        $this->conn = mysqli_connect("localhost", "root", "", "fashionexus_db");

        if (!$this->conn) {
            $this->fail("Test DB connection failed: " . mysqli_connect_error());
        }

        // clean test table before each test
        mysqli_query($this->conn, "DELETE FROM user_form");
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    public function testRegisterSuccess()
    {
        $post = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'abc123',
            'cpassword' => 'abc123',
            'user_type' => 'user'
        ];

        $result = register_user($this->conn, $post);

        $this->assertTrue($result['success']);
        $this->assertEmpty($result['errors']);

        // confirm inserted
        $check = mysqli_query($this->conn, "SELECT * FROM user_form WHERE email='test@gmail.com'");
        $this->assertEquals(1, mysqli_num_rows($check));
    }

    public function testPasswordMismatchFails()
    {
        $post = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'abc123',
            'cpassword' => 'wrong',
            'user_type' => 'user'
        ];

        $result = register_user($this->conn, $post);

        $this->assertFalse($result['success']);
        $this->assertContains('password not matched!', $result['errors']);
    }

    public function testDuplicateUserFails()
    {
        // Insert first user
        $post1 = [
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => 'abc123',
            'cpassword' => 'abc123',
            'user_type' => 'user'
        ];
        register_user($this->conn, $post1);

        // Try same user again
        $result = register_user($this->conn, $post1);

        $this->assertFalse($result['success']);
        $this->assertContains('user already exist!', $result['errors']);
    }
}
