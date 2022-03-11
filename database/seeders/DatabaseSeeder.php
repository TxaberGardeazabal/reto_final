<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
        $MAX_CANTIDAD = 5; // cantidad de un producto en pedidos
        $PROBABILIDAD_DE_OTRO_PRODUCTO = 5; // posibilidad de pedir dos productos diferentes 
        $PROBABILIDAD_DE_OTRO_PEDIDO = 3; // posibilidad de haber dos pedidos diferentes

        $namePool = [
            'Deliciosas magdalenas caseras',
            'Cubiertos de plastico',
            'Cubiertos de metal',
            'Ensalada mixta',
            'Macarrones con tomate',
            'Carolinas',
            'MMmmmh mira este pollo asado',
            'Sopa',
            'El mitiquisimo spaghetti, amado por todos los mortales'
        ];

        $imgPool = [
            'magdalenas.png',
            'cubiertos.jfif',
            'cubiertos.png',
            'ensalada.jfif',
            'macaroni.jfif',
            'merengue.jfif',
            'pollo.jfif',
            'sopa.jfif',
            'spaghetti.png'
        ];

        $ESTADO = [
            'recibido',
            'en proceso',
            'preparado',
            'retrasado'
        ];

        $faker = \Faker\Factory::create();

        // admin account
        $admin = \App\Models\User::create([
            'name' => 'admin',
            'admin' => true,
            'email' => 'admin@admin',
            'email_verified_at' => now(),
            'password' => Hash::make("12345Abcde"),
            'remember_token' => 'abcdefghij'
        ]);
        $admin->save();

        // usuarios
        // usuario de pruebas
        $user = \App\Models\User::create([
            'name' => 'cliente',
            'admin' => false,
            'email' => 'cliente@cliente',
            'email_verified_at' => now(),
            'password' => Hash::make("12345678"),
            'remember_token' => 'abcdefghij'
        ])->save();

        for ($x = 0;$x < $MAX_USUARIOS -1;$x++) {
            $user = \App\Models\User::create([
                'name' => $faker->name(),
                'admin' => false,
                'email' => $faker->email(),
                'email_verified_at' => now(),
                'password' => Hash::make("12345678"),
                'remember_token' => 'abcdefghij'
            ]);

            $user->save();
        }

        // productos
        for ($x = 0;$x < $MAX_PRODUCTOS;$x++) {
            $data = rand(0, count($imgPool) -1);

            $prod = \App\Models\Producto::create([
                'nombre' => $namePool[$data],
                'precio' => $faker->randomFloat(2,0,40),
                'imagen' => $imgPool[$data],
                'descripcion' => $faker->text(50)
            ]);

            $prod->save();
        }
        
        // pedidos
        $pedidos = [];
        for ($x = 0;$x < $MAX_PEDIDOS;$x++) {
            $user;
            //do {
                $e = rand(1,$MAX_USUARIOS);
                $user = \App\Models\User::find($e);
            //} while($user->admin);

            $e = rand(0, count($ESTADO)-1);

            $pedi = \App\Models\Pedido::create([
                'estado' => $ESTADO[$e], 
                'user_id' => $user->id
            ]);

            $pedi->save();
            array_push($pedidos, $pedi);

            $t = rand(1, $PROBABILIDAD_DE_OTRO_PEDIDO); // 1/X pedira otro

            if ($t === 1) {
                $e = rand(0, count($ESTADO)-1);

                $pedi = \App\Models\Pedido::create([
                    'estado' => $ESTADO[$e], 
                    'user_id' => $user->id
                ]);

                $pedi->save();
                array_push($pedidos, $pedi);
            }
        }

        foreach ($pedidos as $idx => $pedido) {
            $producto = \App\Models\Producto::find(rand(1,$MAX_PRODUCTOS));
            $pedido->productos()->attach($producto->id, ['created_at' => now(),'cantidad' => rand(1,$MAX_CANTIDAD)]);

            // algunos pedidos pueden ser de diferentes productos, aqui pongo algun producto extra
            $x = rand(1, $PROBABILIDAD_DE_OTRO_PRODUCTO); // 1/X pedira otro

            if ($x === 1) {
                do {
                    $producto2 = \App\Models\Producto::find(rand(1,$MAX_PRODUCTOS));
                } while($producto->id == $producto2->id); // evitamos duplicar

                $pedido->productos()->attach($producto2->id, ['created_at' => now(),'cantidad' => rand(1,$MAX_CANTIDAD)]);
            }
        }
        

        // \App\Models\User::factory(10)->create();

    }
}
