<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas_vehiculos';
    protected $fillable = [

        'cliente_id',
        'vehiculo_id',
        'fecha_venta',
        'precio',
        'precio_traspaso',
        'total'

    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'vehiculo_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
