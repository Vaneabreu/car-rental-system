<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = 'vehiculos_nueva';
    protected $fillable = [
        'año_vehiculo',
        'color',
        'marca',
        'modelo',
        'matricula',
        'precio_dia',
        'placa',
        'status',
        'imagen'
    ];

    protected $casts = [
        'precio_dia' => 'float',
    ];

    protected $attributes = [
        'status' => 'Activo',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'vehiculo_id');
    }

    public function gastos()
    {
        return $this->hasMany(Gasto::class);
    }

}
