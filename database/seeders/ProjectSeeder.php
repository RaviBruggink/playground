<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Portfolio Website',
            'description' => 'A sleek portfolio site using Laravel and Tailwind CSS.',
            'image' => 'images/portfolio.png',
            'extra_text' => 'This project was my first deep dive into Laravel.'
        ]);
    
        Project::create([
            'title' => 'E-Commerce App',
            'description' => 'A full-featured online shop with cart and payment.',
            'image' => 'images/ecommerce.png',
            'extra_text' => 'Integrates Stripe for payments.'
        ]);
    }
}
