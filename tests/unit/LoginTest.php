<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../index.php";

class LoginTest extends TestCase
{
    private $conn;

    protected function setUp(): void
    {
        //connect to DB
        $this->conn = mysqli_connect("localhost", "root", "", "fashionexus_db");

        if (!$this->conn) {
            $this->fail("Test DB connection failed: " . mysqli_connect_error());
        }

        // reset users before each test
        mysqli_query($this->conn, "DELETE FROM user_form");
    }

    protected function tearDown(): void
    {
        mysqli_close($this->conn);
    }

    private function insertUser($name, $email, $password, $type)
    {
        $pass = md5($password);
        mysqli_query(
            $this->conn,
            "INSERT INTO user_form(name,email,password,user_type)
             VALUES('$name','$email','$pass','$type')"
        );
    }

    public function testAdminLoginSuccess()
    {
        $this->insertUser("Admin One", "admin@gmail.com", "admin123", "admin");

        $post = [
            "email" => "admin@gmail.com",
            "password" => "admin123"
        ];

        $result = login_user($this->conn, $post);

        $this->assertTrue($result["success"]);
        $this->assertEquals("admin", $result["role"]);
        $this->assertEquals("Admin One", $result["name"]);
    }

    public function testUserLoginSuccess()
    {
        $this->insertUser("User One", "user@gmail.com", "user123", "user");

        $post = [
            "email" => "user@gmail.com",
            "password" => "user123"
        ];

        $result = login_user($this->conn, $post);

        $this->assertTrue($result["success"]);
        $this->assertEquals("user", $result["role"]);
        $this->assertEquals("User One", $result["name"]);
    }

    public function testWrongPasswordFails()
    {
        $this->insertUser("User One", "user@gmail.com", "user123", "user");

        $post = [
            "email" => "user@gmail.com",
            "password" => "wrongpass"
        ];

        $result = login_user($this->conn, $post);

        $this->assertFalse($result["success"]);
        $this->assertNull($result["role"]);
        $this->assertContains("Incorrect email or password!", $result["errors"]);
    }

    public function testUnknownEmailFails()
    {
        $post = [
            "email" => "noone@gmail.com",
            "password" => "123"
        ];

        $result = login_user($this->conn, $post);

        $this->assertFalse($result["success"]);
        $this->assertContains("Incorrect email or password!", $result["errors"]);
    }
}
