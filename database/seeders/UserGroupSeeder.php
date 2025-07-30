<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_group')->insert([
            [
                'user_id' => 2,
                'group_id' => 1,  // ada di permission_groups
                'created_by' => null,
            ],
            [
                'user_id' => 3,
                'group_id' => 2,  // ada di permission_groups
                'created_by' => null,
            ],
        ]);
    }
}