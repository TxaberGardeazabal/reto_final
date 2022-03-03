<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $MAX_USUARIOS = 10;
        $MAX_PRODUCTOS = 20;
        $MAX_PEDIDOS = 10;


        $faker = \Faker\Factory::create();

        // admin account
        $admin = \App\Models\User::create([
            'name' => 'admin',
            'admin' => true,
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => '12345Abcde',
            'remember_token' => 'abcdefghij'
        ]);
        $admin->save();

        // usuarios
        for ($x = 0;$x < $MAX_USUARIOS;$x++) {
            $user = \App\Models\User::create([
                'name' => $faker->name(),
                'admin' => false,
                'email' => $faker->email(),
                'email_verified_at' => now(),
                'password' => '12345',
                'remember_token' => 'abcdefghij'
            ]);

            $user->save();
        }

        // productos
        $productos = [];
        for ($x = 0;$x < $MAX_PRODUCTOS;$x++) {
            $prod = \App\Models\Producto::create([
                'nombre' => $faker->sentence(),
                'precio' => $faker->randomFloat(2,0,100),
                'imagen' => $faker->imageUrl(), #mas tarde tendremos imagenes de prueba
                'descripcion' => $faker->text(50)
            ]);

            $prod->save();
            array_push($productos, $prod);
        }
        
        // pedidos
        for ($x = 0;$x < $MAX_PEDIDOS;$x++) {
            do {
                $e = rand(1,$MAX_USUARIOS);
                $user = \App\Models\User::find($e);
            } while($user->admin);

            $pedi = \App\Models\Pedido::create([
                'estado' => 'entregado', // igual cambiar a otro
                'user_id' => $user->id
            ]);

            $pedi->save();
        }



        // \App\Models\User::factory(10)->create();

    }
}
