<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Pedido extends Model
{
    protected $table = 'pedidos';
    protected $fillable = ['cliente_id', 'conductor_id', 'fecha_entrega', 'hora_desde', 'hora_hasta', 'direccion'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function conductor()
    {
        return $this->belongsTo('App\Conductor');
    }


    public function setFechaEntregaAttribute($value){
        if (($timestamp = strtotime(str_replace("/", "-", $value))) === false){
            $this->attributes['fecha_entrega'] = null;
        } else {
            $this->attributes['fecha_entrega'] = date('Ymd', $timestamp) ;
        }
    }


    public function getFechaEntregaAttribute($value){
        return date('d/m/Y', strtotime($value));
    }


    public function scopeHoy($query){
        return $query->where('fecha_entrega', Carbon::today());
    }

}
