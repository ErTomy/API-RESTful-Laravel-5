<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fecha_entrega' => $this->fecha_entrega,
            'direccion' => $this->direccion,
            'hora_desde' => $this->hora_desde,
            'hora_hasta' => $this->hora_hasta,
            'conductor'=>[
                'id'=>$this->conductor->id,
                'nombre'=>$this->conductor->nombre,
            ],
            'cliente'=>[
                'id'=>$this->cliente->id,
                'nombre'=>$this->cliente->nombre,
                'apellidos'=>$this->cliente->apellidos,
                'email'=>$this->cliente->email,
                'telefono'=>$this->cliente->telefono,
            ]
        ];
    }
}
