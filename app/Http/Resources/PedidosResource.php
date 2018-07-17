<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PedidosResource extends JsonResource
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
          'nombre' => $this->cliente->nombre,
          'apellidos' => $this->cliente->apellidos,
          'email' => $this->cliente->email,
          'telefono' => $this->cliente->telefono,
          'direccion' => $this->direccion,
          'hora_desde' => $this->hora_desde,
          'hora_hasta' => $this->hora_hasta,
        ];
    }
}
