<?php

namespace app\Model;

use Illuminate\Database\Eloquent\Model;


class Depart extends Model {

    protected $table='depart';
    protected $primaryKey='depart_no';
    public $timestamps=false;
    protected $fillable=['depart_no','dnombre','loc'];


    
    
}