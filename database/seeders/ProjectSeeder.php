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
            'title' => 'Portflow Concept',
            'description' => 'A UX/UI redesign and conceptual overhaul of the Fontys Portflow portfolio tool.',
            'image' => 'storage/images/placeholder.svg',
            'extra_text' => 'As part of a multidisciplinary team of 4 students, we reimagined the Portflow tool to better align with user needs and educational goals. We focused on improving usability, streamlining the interface, and introducing features like customizable modules and improved reflection workflows.'
        ]);

        Project::create([
            'title' => 'Driv-R App',
            'description' => 'A fully-functional e-commerce application for a fictional electric car rental service.',
            'image' => 'storage/images/placeholder.svg',
            'extra_text' => 'This project included user authentication, a dynamic shopping cart, and Stripe integration for secure payments. The frontend was built in Vue.js while the backend used Laravel, showcasing full-stack development and API communication.'
        ]);

        Project::create([
            'title' => 'WellNest Mobile',
            'description' => 'A self-care and mindfulness app designed to help users build healthier daily habits.',
            'image' => 'storage/images/placeholder.svg',
            'extra_text' => 'Developed with Flutter, WellNest includes features like daily mood tracking, guided meditations, habit-building streaks, and a personalized dashboard. Emphasis was placed on UI responsiveness and data visualization.'
        ]);
    }
}