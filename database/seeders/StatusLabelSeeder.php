<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusLabel;

class StatusLabelSeeder extends Seeder
{
    public function run(): void
    {
        StatusLabel::insert([
            [
                'id' => 1,
                'name' => 'Pending',
                'created_by' => 1,
                'pending' => true,
                'notes' => 'These assets are not yet ready to be deployed, usually because of configuration or waiting on parts.',
                'deployable' => false,
                'archived' => false,
                'color' => null,
                'show_in_nav' => false,
                'default_label' => false,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'name' => 'Dapat digunakan',
                'created_by' => 1,
                'deployable' => true,
                'pending' => false,
                'archived' => false,
                'notes' => 'These assets are ready to deploy.',
                'color' => '#aa3399',
                'show_in_nav' => false,
                'default_label' => false,
                'created_at' => now(),
                'updated_at' => '2025-05-19 08:49:00',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'name' => 'Diarsipkan',
                'created_by' => 1,
                'deployable' => false,
                'pending' => false,
                'archived' => true,
                'notes' => 'These assets are no longer in circulation or viable.',
                'color' => '#aa3399',
                'show_in_nav' => false,
                'default_label' => false,
                'created_at' => now(),
                'updated_at' => '2025-05-19 08:49:00',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'name' => 'Dipinjamkan',
                'created_by' => 1,
                'deployable' => false,
                'pending' => false,
                'archived' => false,
                'notes' => null,
                'color' => '#9daa33',
                'show_in_nav' => true,
                'default_label' => true,
                'created_at' => '2025-05-21 02:31:00',
                'updated_at' => '2025-05-22 03:38:00',
                'deleted_at' => '2025-05-22 03:38:00',
            ],
        ]);
    }
}
