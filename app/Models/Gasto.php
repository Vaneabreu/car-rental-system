<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    protected $table = 'gastos_nueva';
    protected $fillable = [
        'descripcion',
        'monto',
        'vehiculo_id',
        'fecha_gasto',
        'total',
        'status'
    ];

    protected $attributes = [
        'status' => 'Activo',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    /* public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id', 'id');
    } */

}
