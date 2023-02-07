<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Empresa;
use App\Models\MotivosDeParada;
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
        Role::create(['name' => 'colaborador']);

        Empresa::factory()->create([
            'name' => 'Agostini Consultoria'
        ]);

        User::factory()->create([
            'name' => 'Super Administrador',
            'username' => 'super-admin',
            'email' => 'super-admin@agostinitecnologia.com.br',
            'empresa_id' => 1,
        ])->assignRole('super-administrador');

        User::factory()->create([
            'name' => 'Administrador',
            'username' => 'admin',
            'email' => 'admin@agostinitecnologia.com.br',
            'empresa_id' => 1,
        ])->assignRole('administrador');

        User::factory()->create([
            'name' => 'Colaborador',
            'username' => 'colab',
            'email' => 'colab@agostinitecnologia.com.br',
            'empresa_id' => 1,
        ])->assignRole('colaborador');

        MotivosDeParada::create(['name' => 'Fim do Expediente']);
        MotivosDeParada::create(['name' => 'Banheiro']);
        MotivosDeParada::create(['name' => 'Manutenção']);
        MotivosDeParada::create(['name' => 'Almoço']);
        MotivosDeParada::create(['name' => 'Buscar Peças/Material']);
    }
}
