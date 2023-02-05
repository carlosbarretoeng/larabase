<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Empresa;
use App\Models\User;
use Faker\Factory;
use App\Models\UsuarioPorEmpresa;
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
        $faker = Factory::create();

        Role::create(['name' => 'super-administrador']);
        Role::create(['name' => 'administrador']);

        Empresa::factory()->create([
            'name' => 'Agostini Consultoria'
        ]);

        User::factory()->create([
            'name' => 'Super Administrador',
            'username' => 'super-admin',
            'email' => 'super-admin@agostinitecnologia.com.br',
            'empresa_id' => 1,
        ])->assignRole('super-administrador')->assignRole('administrador');

        Empresa::factory(3)->create();

        User::factory(19)->create();
    }
}
