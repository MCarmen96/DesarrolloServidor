<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model{

    protected $table='user';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable=['nombre','password','compra'];

}