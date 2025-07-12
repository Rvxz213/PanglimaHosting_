<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PanglimaHostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('PanglimaHosting');
    }

    public function test_products_page_loads()
    {
        $response = $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Produk');
    }

    public function test_admin_login_page_loads()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    public function test_admin_can_login()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticated();
    }

    public function test_product_can_be_created()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now(),
        ]);

        $this->actingAs($admin);

        $response = $this->post('/admin/products', [
            'name' => 'Test VPS',
            'description' => 'Test VPS Description',
            'type' => 'vps',
            'price' => 500000,
            'features' => ['CPU: 1 Core', 'RAM: 1 GB']
        ]);

        $response->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Test VPS',
            'type' => 'vps',
            'price' => 500000
        ]);
    }

    public function test_cart_functionality()
    {
        // Create a product
        $product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'type' => 'vps',
            'price' => 100000,
            'features' => ['Test Feature']
        ]);

        // Add to cart
        $response = $this->post('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        $response->assertRedirect();
        $this->assertSessionHas('cart');
        
        // Check cart page
        $response = $this->get('/cart');
        $response->assertStatus(200);
        $response->assertSee('Test Product');
    }
} 