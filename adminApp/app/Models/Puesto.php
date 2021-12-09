<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    
    protected $table = 'puesto';
    
    public $timestamps = false;
    
    protected $fillable = ['name', 'min', 'max', ];
    
    protected $attributes = ['min' => 0, 'max' => 0, ];
    
    public function empleado () {
        return $this->belongsTo ('App\Models\Event', 'idpuesto');
    }
}
