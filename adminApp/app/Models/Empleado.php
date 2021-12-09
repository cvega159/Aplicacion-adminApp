<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    
    protected $table = 'empleado';
    
    protected $fillable = ['name', 'apellidos', 'email', 'telefono', 'fechacontrato','idpuesto','iddepartamento',];
    
    public function puesto () {//hasMany en un empleado tiene varios puestos
        return $this->belongsTo ('App\Models\Puesto', 'idpuesto');//belongsTo un empleado permanece a un puesto
    }    
    
    public function departamento () {
        return $this->belongsTo ('App\Models\Departamento', 'iddepartamento');
    }
}
