<?php

namespace Database\Seeders;

use App\Models\RoleUser;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PermissionsSeeder::class]);

        User::factory(10)->create();
    }
}
