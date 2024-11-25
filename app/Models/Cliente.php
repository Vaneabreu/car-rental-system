<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes_nueva';

    protected $fillable = [
        'nombre',
        'nombre_completo',
        'apellido',
        'telefono',
        'direccion',
        'genero',
        'cedula',
        'status'
    ];

    protected $attributes = [
        'status' => 'Activo',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

}
