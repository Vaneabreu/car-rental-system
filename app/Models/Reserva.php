<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas_new';

    protected $fillable = [
        'vehiculo_id',
        'reserva_id',
        'gastos_id',
        'dias_renta',
        'fecha_reserva',
        'fecha_salida',
        'fecha_entrada',
        'comision',
        'precio_dia',
        'total',
        'gastos',
        'status'
    ];


    protected $attributes = [
        'status' => 'Activa',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }


    public function gastos()
    {
        return $this->belongsTo(Gasto::class, 'gastos_id', 'id');
    }

  /*   public function gastos()
    {
        return $this->hasMany(Gasto::class, 'vehiculo_id', 'vehiculo_id');
    } */

    public function getFullNameAttribute()
    {
        return join(' ', [optional($this->Cliente)->nombre, optional($this->Profile)->apellido]);
    }
}
