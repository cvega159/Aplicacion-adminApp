<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;
    
    protected $table = 'departamento';
    
    protected $fillable = ['name', 'location', 'jefeDep', ];
    
    public function empleados () {//un departamento tiene varios empleados
        return $this->hasMany ('App\Models\Empleado', 'iddepartamento');
    }
    
    public function jefe () {//un departamento tiene varios empleados
        return $this->belongsTo ('App\Models\Empleado', 'jefeDep');
    }
    //cuando tengo una dependencia tengo dos relaciones una de la tabla origen a la destino, y otra de la destino a la origen
}
