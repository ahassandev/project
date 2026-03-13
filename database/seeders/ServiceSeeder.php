<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. CERTIFICATION
        $certification = Service::create([
            'title' => 'CERTIFICATION',
            'description' => 'Professional certification services.',
        ]);

        $certification->children()->createMany([
            ['title' => 'Lean Manufacturing', 'description' => 'Efficiency enhancement via lean principles.'],
            ['title' => 'Practical 5S', 'description' => 'Workplace organization and standardization.'],
            ['title' => 'CE Marking', 'description' => 'Conformity marking for products sold in the EEA.'],
        ]);

        // 2. Food Safety
        $foodSafety = Service::create([
            'title' => 'Food Safety',
            'description' => 'Ensuring standards in food production and handling.',
        ]);

        $foodSafety->children()->createMany([
            ['title' => 'ISO 22000', 'description' => 'Food safety management systems.'],
            ['title' => 'FSSC 22000', 'description' => 'Food Safety System Certification.'],
            ['title' => 'HALAL/KOSHAR', 'description' => 'Halal and Koshar certification services.'],
            ['title' => 'BRC', 'description' => 'British Retail Consortium global standards.'],
        ]);

        // 3. OH & Safety
        $ohs = Service::create([
            'title' => 'OH & Safety',
            'description' => 'Occupational Health and Safety standards.',
        ]);

        $ohs->children()->createMany([
            ['title' => 'ISO 45001', 'description' => 'Health and safety at work.'],
        ]);

        // 4. Social Compliance
        $social = Service::create([
            'title' => 'Social Compliance',
            'description' => 'Ethics and social responsibility in business.',
        ]);

        // 5. Quality Management
        $quality = Service::create([
            'title' => 'Quality Management',
            'description' => 'Quality control and management systems.',
        ]);

        $quality->children()->createMany([
            ['title' => 'ISO 9001', 'description' => 'Quality management systems.'],
        ]);

        // 6. EM Management
        $em = Service::create([
            'title' => 'EM Management',
            'description' => 'Environmental Management systems.',
        ]);

        $em->children()->createMany([
            ['title' => 'ISO 14001', 'description' => 'Environmental management standards.'],
        ]);

        // 7. Check Certificate (Special Service)
        Service::create([
            'title' => 'Check Certificate',
            'description' => 'Verify your certification online.',
        ]);
    }
}
