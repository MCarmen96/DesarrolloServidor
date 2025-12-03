<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depart extends Model
{
    //
    protected $fillable=['depart_no','dnombre','loc'];
    protected $table='departs';
    protected $primaryKey='depart_no';
    public $incrementing = false;
    // un departamento tiene muchos empleados
    public function emple(){
        return $this->hasMany(Emple::class,'depart_no');
    }

}
