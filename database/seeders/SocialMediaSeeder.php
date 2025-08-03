<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMediaData = [
            [
                'platform' => 'instagram',
                'name' => 'Instagram',
                'url' => 'https://instagram.com/mercubuana_yogya',
                'icon_class' => 'fab fa-instagram',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'platform' => 'facebook',
                'name' => 'Facebook',
                'url' => 'https://facebook.com/mercubuana.yogya',
                'icon_class' => 'fab fa-facebook',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'platform' => 'twitter',
                'name' => 'Twitter',
                'url' => 'https://twitter.com/mercubuana_yogya',
                'icon_class' => 'fab fa-twitter',
                'is_active' => false,
                'sort_order' => 3
            ],
            [
                'platform' => 'youtube',
                'name' => 'YouTube',
                'url' => 'https://youtube.com/c/mercubuana-yogya',
                'icon_class' => 'fab fa-youtube',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'platform' => 'tiktok',
                'name' => 'TikTok',
                'url' => 'https://tiktok.com/@mercubuana_yogya',
                'icon_class' => 'fab fa-tiktok',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'platform' => 'linkedin',
                'name' => 'LinkedIn',
                'url' => 'https://linkedin.com/company/mercubuana-yogya',
                'icon_class' => 'fab fa-linkedin',
                'is_active' => false,
                'sort_order' => 6
            ]
        ];

        foreach ($socialMediaData as $social) {
            SocialMedia::updateOrCreate(
                ['platform' => $social['platform']],
                $social
            );
        }
    }
}
