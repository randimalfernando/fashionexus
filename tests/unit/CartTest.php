<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../../user/cart.php";

class CartTest extends TestCase
{
    public function testAddToCartCreatesItem()
    {
        $cart = [];

        $product = [
            'id' => 1,
            'name' => 'T-Shirt',
            'price' => 20.0,
            'pic' => 'shirt.png',
        ];

        cart_add_item($cart, $product, 1);

        $this->assertCount(1, $cart);
        $this->assertEquals(1, $cart[1]['qty']);
        $this->assertEquals('T-Shirt', $cart[1]['name']);
    }

    public function testAddToCartIncreasesQtyIfSameProduct()
    {
        $cart = [];

        $product = [
            'id' => 1,
            'name' => 'T-Shirt',
            'price' => 20.0,
            'pic' => 'shirt.png',
        ];

        cart_add_item($cart, $product, 1);
        cart_add_item($cart, $product, 2);

        $this->assertEquals(3, $cart[1]['qty']);
    }

    public function testRemoveFromCart()
    {
        $cart = [
            1 => ['id'=>1,'name'=>'T-Shirt','price'=>20,'pic'=>'shirt.png','qty'=>2]
        ];

        $cart = cart_apply_action($cart, 'remove', 1);

        $this->assertCount(0, $cart);
    }

    public function testClearCart()
    {
        $cart = [
            1 => ['id'=>1,'name'=>'T-Shirt','price'=>20,'pic'=>'shirt.png','qty'=>2],
            2 => ['id'=>2,'name'=>'Hat','price'=>10,'pic'=>'hat.png','qty'=>1],
        ];

        $cart = cart_apply_action($cart, 'clear', 0);

        $this->assertEmpty($cart);
    }

    public function testIncreaseQuantity()
    {
        $cart = [
            1 => ['id'=>1,'name'=>'T-Shirt','price'=>20,'pic'=>'shirt.png','qty'=>1]
        ];

        $cart = cart_apply_action($cart, 'increase', 1);

        $this->assertEquals(2, $cart[1]['qty']);
    }

    public function testDecreaseQuantityRemovesWhenQtyBecomesZero()
    {
        $cart = [
            1 => ['id'=>1,'name'=>'T-Shirt','price'=>20,'pic'=>'shirt.png','qty'=>1]
        ];

        $cart = cart_apply_action($cart, 'decrease', 1);

        $this->assertCount(0, $cart);
    }
}
