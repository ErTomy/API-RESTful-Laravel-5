<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table = 'conductores';
    protected $fillable = ['nombre', 'token'];

    public function pedidos()
    {
        return $this->hasMany('App\Pedido')->latest();
    }
}
