<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizaciones extends Model
{
    protected $table = 'cotizaciones';

    protected $fillable = [
        'vehiculo_id',
        'fecha_salida',
        'fecha_entrada',
        'dias_renta',
        'precio_dia',
        'total',
        'status'
    ];

    protected $attributes = [
        'status' => 'Activa',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }
}
