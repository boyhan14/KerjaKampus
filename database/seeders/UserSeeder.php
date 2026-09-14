<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password');

        // Admin
        User::create([
            'name' => 'Admin KerjaKampus',
            'username' => 'admin',
            'email' => 'admin@kerjakampus.com',
            'password' => $password,
            'role' => 'admin',
            'roles' => ['admin'],
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Talents
        $talents = [
            ['name' => 'Andi Pratama', 'username' => 'andipratama', 'location' => 'Jakarta', 'education' => 'Universitas Indonesia', 'bio' => 'Full-stack developer dengan pengalaman 3 tahun di bidang web development. Passionate tentang Laravel dan React.'],
            ['name' => 'Siti Nurhaliza', 'username' => 'sitinurhaliza', 'location' => 'Bandung', 'education' => 'Institut Teknologi Bandung', 'bio' => 'UI/UX Designer dengan keahlian di Figma dan Adobe XD. Fokus pada user-centered design.'],
            ['name' => 'Budi Santoso', 'username' => 'budisantoso', 'location' => 'Surabaya', 'education' => 'ITS Surabaya', 'bio' => 'Mobile developer Flutter dan React Native. Sudah mengembangkan 10+ aplikasi mobile.'],
            ['name' => 'Dewi Lestari', 'username' => 'dewilestari', 'location' => 'Yogyakarta', 'education' => 'UGM Yogyakarta', 'bio' => 'Content writer dan copywriter berpengalaman. Spesialisasi di konten teknologi dan startup.'],
            ['name' => 'Rizky Maulana', 'username' => 'rizkymaulana', 'location' => 'Semarang', 'education' => 'Universitas Diponegoro', 'bio' => 'Data analyst dan Python developer. Berpengalaman dalam data visualization dan machine learning.'],
            ['name' => 'Putri Handayani', 'username' => 'putrihandayani', 'location' => 'Malang', 'education' => 'Universitas Brawijaya', 'bio' => 'Graphic designer kreatif dengan portfolio di branding dan social media design.'],
            ['name' => 'Ahmad Fauzi', 'username' => 'ahmadfauzi', 'location' => 'Jakarta', 'education' => 'Universitas Bina Nusantara', 'bio' => 'Backend developer dengan keahlian PHP, Laravel, dan PostgreSQL. Clean code enthusiast.'],
            ['name' => 'Maya Sari', 'username' => 'mayasari', 'location' => 'Bandung', 'education' => 'Telkom University', 'bio' => 'Digital marketer dengan spesialisasi SEO dan social media marketing.'],
            ['name' => 'Fajar Nugroho', 'username' => 'fajarnugroho', 'location' => 'Yogyakarta', 'education' => 'Universitas Atma Jaya', 'bio' => 'Video editor dan motion graphics designer. Berpengalaman di produksi konten YouTube.'],
            ['name' => 'Indah Permata', 'username' => 'indahpermata', 'location' => 'Surabaya', 'education' => 'Universitas Airlangga', 'bio' => 'Frontend developer dengan keahlian React, Next.js, dan Tailwind CSS. Membangun UI yang indah dan responsif.'],
        ];

        $skills = Skill::all();

        foreach ($talents as $index => $t) {
            $user = User::create([
                'name' => $t['name'],
                'username' => $t['username'],
                'email' => $t['username'] . '@example.com',
                'password' => $password,
                'role' => 'talent',
                'roles' => ['talent'],
                'status' => 'active',
                'bio' => $t['bio'],
                'location' => $t['location'],
                'education' => $t['education'],
                'experience_years' => rand(1, 5),
                'linkedin_url' => 'https://linkedin.com/in/' . $t['username'],
                'github_url' => $index % 2 === 0 ? 'https://github.com/' . $t['username'] : null,
                'is_available' => true,
                'email_verified_at' => now(),
            ]);

            if ($skills->count() > 0) {
                $user->skills()->attach($skills->random(rand(3, 7))->pluck('id'));
            }
        }

        // Clients
        $clients = [
            ['name' => 'Rudi Hermawan', 'username' => 'digitalkreasi', 'company' => 'PT Digital Kreasi', 'location' => 'Jakarta', 'desc' => 'Perusahaan teknologi yang bergerak di bidang solusi digital untuk UMKM dan enterprise.'],
            ['name' => 'Lia Kusuma', 'username' => 'startupnusantara', 'company' => 'Startup Nusantara', 'location' => 'Bandung', 'desc' => 'Startup edtech yang fokus pada platform pembelajaran online untuk mahasiswa Indonesia.'],
            ['name' => 'Dimas Prasetyo', 'username' => 'kedaikopidigital', 'company' => 'Kedai Kopi Digital', 'location' => 'Yogyakarta', 'desc' => 'Brand kopi lokal yang mengintegrasikan teknologi digital dalam operasional bisnisnya.'],
            ['name' => 'Novi Anggraini', 'username' => 'umkmmajubersama', 'company' => 'UMKM Maju Bersama', 'location' => 'Surabaya', 'desc' => 'Komunitas UMKM yang membantu pelaku usaha kecil go-digital dan scale up.'],
            ['name' => 'Arif Wicaksono', 'username' => 'campusinnovation', 'company' => 'Campus Innovation Lab', 'location' => 'Malang', 'desc' => 'Lab inovasi kampus yang menghubungkan mahasiswa dengan proyek riset dan pengembangan.'],
        ];

        foreach ($clients as $c) {
            User::create([
                'name' => $c['name'],
                'username' => $c['username'],
                'email' => $c['username'] . '@example.com',
                'password' => $password,
                'role' => 'client',
                'roles' => ['client'],
                'status' => 'active',
                'company_name' => $c['company'],
                'company_description' => $c['desc'],
                'location' => $c['location'],
                'website' => 'https://' . $c['username'] . '.com',
                'email_verified_at' => now(),
            ]);
        }
    }
}
