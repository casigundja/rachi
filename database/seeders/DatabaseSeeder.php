<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BusinessUnitSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AdminUserSeeder::class,
            CategorySeeder::class,
            ServiceSeeder::class,
            ProductSeeder::class,
            CourseSeeder::class,
            ServiceRequestSeeder::class,
        ]);
    }
}
