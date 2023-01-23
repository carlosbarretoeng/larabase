<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'super-administrador']);
        Role::create(['name' => 'administrador']);

        User::factory()->create([
            'name' => 'Super Administrador',
            'email' => 'super-admin@agostinitecnologia.com.br',
        ])->assignRole('super-administrador');

        User::factory(2)->create();
    }
}
