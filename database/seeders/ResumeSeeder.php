<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Resume;

class ResumeSeeder extends Seeder
{
    public function run(): void
    {
        Resume::create([
            'user_id' => 1,
            'full_name' => 'BRUAL, KEIRK XANDREX M.',
            'email' => '23-02544@g.batstate-u.edu.ph',
            'field' => 'Computer Science Student',
            'about' => 'Proficient in database design and optimization.',
            'github' => 'https://github.com/keirkbrual',
            'address' => 'Bolo, Bauan, Batangas',
            'phone' => '09944639633',
            'profile_image' => 'images/profile.jpg',
            'skills' => json_encode(['MySQL','PostgreSQL','SQL Server']),
            'education' => json_encode([
                [
                    'level' => 'College',
                    'school' => 'Batangas State University - Alangilan',
                    'year' => 'Expected 2027',
                    'course' => 'BS Computer Science',
                    'relevant' => ['Data Structures','Data Analysis','Cloud Computing']
                ]
            ]),
            'experience' => json_encode([
                ['project' => 'Ambag App', 'description' => 'Developed an expense tracker app.'],
                ['project' => 'Immunization Tracker', 'description' => 'Built an OOP-based tracker in Java.']
            ])
        ]);
    }
}
