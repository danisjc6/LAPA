<?php

namespace Database\Seeders;

use App\Models\Conta;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'Administrador',
            'cpf' => '122.433.655-23',
            'email' => 'admin@admin.com',
        ]);

        $admin['slug'] = str_slug($admin->name).'-'.$admin->id;
        $admin->update($admin->attributesToArray());

        Conta::factory()->create([
            'password' => Hash::make('password'),
            'user_id' => $admin->id,
        ]);


    }
}
