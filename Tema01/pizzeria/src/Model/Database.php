<?php

namespace app\Model;

use Illuminate\Database\Capsule\Manager as Capsule;
use app\Model\Pizzas;

class Database
{

    public function __construct()
    {
        try {
            $capsule = new Capsule;

            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'database' => 'pizzeria',
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            error_log("conectado a base de datos");
        } catch (\Exception $e) {
            die("Error al conectar a la base d e datos" . $e->getMessage());
        }
    }

    public function listPizzas()
    {

        $pizzas = Pizzas::all();

        return $pizzas;
    }

    public function delete($id)
    {

        $pizza = Pizzas::find($id);
        if ($pizza) {
            $pizza->delete();
        } else {
            error_log("Pizza no encontrada");
        }
    }

    public function giveForEdit($id)
    {
        $arrayP = [];
        $pizza = Pizzas::find($id);
        if ($pizza) {
            $arrayP = $pizza;
            error_log(json_encode($pizza) . "---Pizza encontrada");
        } else {
            error_log("Pizza no encontrada");
        }
        return $arrayP;
    }

    public function saveEdit($name, $ingred, $alerg, $id, $precio)
    {

        $pizza = Pizzas::find($id);
        $encontrada = false;
        if ($pizza) {
            $pizza->nombre = $name;
            $pizza->ingredientes = $ingred;
            $pizza->alergenos = $alerg;
            $pizza->precio = $precio;

            $pizza->save();

            $encontrada = true;
        } else {
            error_log("pizza no encontrada");
        }
        return $encontrada;
    }

    public function saveCreate($name, $id, $ingred, $alerg, $precio)
    {
        try {
            Pizzas::create([
                'nombre' => $name,
                'id' => $id,
                'ingredientes' => $ingred,
                'alergenos' => $alerg,
                'precio' => $precio
            ]);
        } catch (\Exception $e) {
            die("Error al insertar pizza...." . $e->getMessage());
        }
    }
}
