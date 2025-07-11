<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StatusLabelsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_labels')->insert([
            [
                'id' => 1,
                'name' => 'Pending',
                'created_by' => 1,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
                'deployable' => 0,
                'pending' => 1,
                'archived' => 0,
                'notes' => 'These assets are not yet ready to be deployed, usually because of configuration or waiting on parts.',
            ],
            [
                'id' => 2,
                'name' => 'Dapat digunakan',
                'created_by' => 1,
                'created_at' => null,
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '19/05/2025 8:49'),
                'deleted_at' => null,
                'deployable' => 1,
                'pending' => 0,
                'archived' => 0,
                'notes' => 'These assets are ready to deploy.',
            ],
            [
                'id' => 3,
                'name' => 'Diarsipkan',
                'created_by' => 1,
                'created_at' => null,
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '19/05/2025 8:49'),
                'deleted_at' => null,
                'deployable' => 0,
                'pending' => 0,
                'archived' => 1,
                'notes' => 'These assets are no longer in circulation or viable.',
            ],
            [
                'id' => 4,
                'name' => 'Dipinjamkan',
                'created_by' => 1,
                'created_at' => Carbon::createFromFormat('d/m/Y H:i', '21/05/2025 2:31'),
                'updated_at' => Carbon::createFromFormat('d/m/Y H:i', '22/05/2025 3:38'),
                'deleted_at' => Carbon::createFromFormat('d/m/Y H:i', '22/05/2025 3:38'),
                'deployable' => 0,
                'pending' => 0,
                'archived' => 0,
                'notes' => null,
            ],
        ]);
    }
}
