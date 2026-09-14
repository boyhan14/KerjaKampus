<?php

namespace Database\Seeders;

use App\Models\PortfolioItem;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $talents = User::where('role', 'talent')->get();
        $skills = Skill::all();

        if ($talents->isEmpty()) {
            return;
        }

        $portfolios = [
            'Website E-Commerce Fashion',
            'Aplikasi Manajemen Perpustakaan',
            'Landing Page Startup',
            'Mobile App Kesehatan',
            'Dashboard Analytics Penjualan',
            'UI Design Food Delivery',
            'Logo Brand Kopi Nusantara',
            'Social Media Campaign',
            'Desain Poster Event Kampus',
            'Video Company Profile',
            'Artikel Blog SEO Teknologi',
            'Analisis Data Penjualan Q1',
            'Pembuatan Konten TikTok',
            'Sistem Kasir Toko Baju',
            'Redesign Website Universitas'
        ];

        foreach ($portfolios as $title) {
            $talent = $talents->random();
            
            $portfolio = PortfolioItem::create([
                'user_id' => $talent->id,
                'title' => $title,
                'slug' => Str::slug($title . '-' . Str::random(4)),
                'description' => 'Ini adalah proyek ' . $title . ' yang telah berhasil diselesaikan dengan baik dan memuaskan.',
                'category' => 'Proyek Spesifik',
                'demo_url' => 'https://example.com/demo/' . Str::slug($title),
                'is_published' => true,
            ]);

            if ($skills->count() > 0) {
                $portfolio->skills()->attach($skills->random(rand(2, 5))->pluck('id'));
            }
        }
    }
}
