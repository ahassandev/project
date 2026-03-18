<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\About::updateOrCreate(
            ['id' => 1],
            [
                'title' => 'About Us',
                'mission_title' => 'Our Mission',
                'mission_content' => 'To emerge as a world-class Consultancy and Certification solutions provider by delivering value-managed services and building sustainability in the performance of organizations.',
                'vision_title' => 'Our Vision',
                'vision_content' => 'ISO SYSTEMS is committed to deliver value-based services and to achieve the utmost satisfaction of our customers and continue improvement in all our processes.',
                'team_content' => 'Our consultancy team comprises highly professional, trained, and industry-active experts to make the following services deliverable by our team of experts. Our professionals are grouped by industry focus and deliver specialized solutions to clients for personal interest in each aspect of quality management systems across the industry effectively and efficiently.',
                'standards_content' => 'We work with a variety of organizations in the setting management systems of the major commercial activity, some where a great focus is made to improve efficiencies in their operations to minimize wastage, rejection and so to improve their marketability.',
                'excellence_content' => 'ISO SYSTEMS has been recognized for delivering "THE VALUE FOCUS" to the way businesses are serving for over 20 years. Our determined focus on Quality Management and Food Safety has marked our way to success.',
                'professional_statement' => 'Helping organizations navigate complexity through world-recognized certification and technical consultancy since 1999.',
                'hero_image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80',
                'expertise_label' => 'Our Expertise',
                'expertise_title' => 'WE ARE THE LEADER IN CONSULTANCY & CERTIFICATIONS',
                'expertise_subtitle' => '"ISO SYSTEMS RECOGNIZED FOR DELIVERING THE VALUE FOCUS TO THE WAY BUSINESSES ARE SERVING SINCE LAST 20 YEARS."',
                'expertise_description' => 'Through our determined focus on Quality Management Solutions, Quality Certification, and Consultancy, we have marked our way to success and have won accolades for our clients across industries.',
                'expertise_image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?auto=format&fit=crop&q=80',
                'expertise_experience_years' => '20+',
            ]
        );
    }
}
