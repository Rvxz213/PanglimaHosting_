<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'VPS Basic',
                'description' => 'Virtual Private Server untuk kebutuhan hosting dasar',
                'type' => 'vps',
                'price' => 500000, // 500k IDR
                'features' => [
                    'CPU: 1 Core',
                    'RAM: 1 GB',
                    'Storage: 20 GB SSD',
                    'Bandwidth: 1 TB',
                    'IP: 1 IPv4',
                    'OS: Ubuntu/CentOS'
                ]
            ],
            [
                'name' => 'VPS Standard',
                'description' => 'VPS dengan performa optimal untuk bisnis menengah',
                'type' => 'vps',
                'price' => 1000000, // 1M IDR
                'features' => [
                    'CPU: 2 Core',
                    'RAM: 4 GB',
                    'Storage: 50 GB SSD',
                    'Bandwidth: 2 TB',
                    'IP: 1 IPv4',
                    'OS: Ubuntu/CentOS/Windows'
                ]
            ],
            [
                'name' => 'VPS Premium',
                'description' => 'VPS high-performance untuk aplikasi enterprise',
                'type' => 'vps',
                'price' => 2000000, // 2M IDR
                'features' => [
                    'CPU: 4 Core',
                    'RAM: 8 GB',
                    'Storage: 100 GB SSD',
                    'Bandwidth: 5 TB',
                    'IP: 2 IPv4',
                    'OS: Ubuntu/CentOS/Windows'
                ]
            ],
            [
                'name' => 'Shared Hosting Basic',
                'description' => 'Shared hosting untuk website personal',
                'type' => 'hosting',
                'price' => 100000, // 100k IDR
                'features' => [
                    'Storage: 1 GB',
                    'Bandwidth: 10 GB',
                    'Email: 5 Akun',
                    'Database: 1 MySQL',
                    'SSL: Gratis',
                    'cPanel: Ya'
                ]
            ],
            [
                'name' => 'Shared Hosting Pro',
                'description' => 'Shared hosting untuk website bisnis',
                'type' => 'hosting',
                'price' => 250000, // 250k IDR
                'features' => [
                    'Storage: 5 GB',
                    'Bandwidth: 50 GB',
                    'Email: 25 Akun',
                    'Database: 5 MySQL',
                    'SSL: Gratis',
                    'cPanel: Ya'
                ]
            ],
            [
                'name' => 'Shared Hosting Business',
                'description' => 'Shared hosting untuk website enterprise',
                'type' => 'hosting',
                'price' => 500000, // 500k IDR
                'features' => [
                    'Storage: 20 GB',
                    'Bandwidth: 200 GB',
                    'Email: 100 Akun',
                    'Database: 20 MySQL',
                    'SSL: Gratis',
                    'cPanel: Ya'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
