<?php

use App\Conta;
use App\User;
use Illuminate\Database\Seeder;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = factory(App\User::class)->create([
            'name' => 'Administrador',
            'cpf' => '122.433.655-23',
            'email' => 'admin@admin.com',
        ]);

        $admin['slug'] = str_slug($admin->name).'-'.$admin->id;
        $admin->update($admin->attributesToArray());

        factory(App\Conta::class)->create([
            'password' => bcrypt('password'),
            'user_id' => $admin->id,
        ]);


    }
}
