<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactInfo;

class ContactInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactData = [
            [
                'key' => 'email',
                'label' => 'Email',
                'value' => 'info@mercubuana-yogya.ac.id',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'key' => 'phone',
                'label' => 'Telepon',
                'value' => '(0274) 123456',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'key' => 'address',
                'label' => 'Alamat',
                'value' => 'Jl. Wates Km. 10, Argomulyo, Sedayu, Bantul, Yogyakarta 55753',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'key' => 'fax',
                'label' => 'Fax',
                'value' => '(0274) 798888',
                'is_active' => false,
                'sort_order' => 4
            ]
        ];

        foreach ($contactData as $contact) {
            ContactInfo::updateOrCreate(
                ['key' => $contact['key']],
                $contact
            );
        }
    }
}
