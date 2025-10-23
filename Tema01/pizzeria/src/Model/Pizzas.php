<?php
namespace app\Model;

use Illuminate\Database\Eloquent\Model;

class Pizzas extends Model {

    protected $table='pizzas';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=['id','nombre','ingredientes','alergenos','precio'];

}