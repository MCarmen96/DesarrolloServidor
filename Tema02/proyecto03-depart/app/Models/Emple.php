<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emple extends Model
{
    //
    protected $fillable = ['emple_no','apellido','oficio','dir','fecha_alt','salario','comision','depart_no'];
    protected $primaryKey='emple_no';
    public $incrementing = false;
    // un empleado pertenece solo a un departamento
    public function depart(){
        return $this->belongsTo(Depart::class,'depart_no');
    }
    // un empleado solo tiene un director
    public function director(){
        return $this->belongsTo(Emple::class,'dir');
    }
    // un director tiene varios empleados
    public function empleados(){
        return $this->hasMany(Emple::class,'emple_no');
    }
}
