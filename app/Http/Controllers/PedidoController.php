<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use Illuminate\Http\Request;

use App\Http\Resources\PedidosResource;

use App\Conductor;
use App\Cliente;
use App\Pedido;

class PedidoController extends Controller
{

    public function nuevo(PedidoRequest $request){
        $cliente = Cliente::where('email', $request->input('email'))->first();

        if(!isset($cliente)){ // el cliente no esta registrado
            $cliente = Cliente::create([
                'nombre'=>$request->input('nombre'),
                'apellidos'=>$request->input('apellidos'),
                'email'=>$request->input('email'),
                'telefono'=>$request->input('telefono')
            ]);
        }

        $conductor = Conductor::inRandomOrder()->first(); // seleccionamos un conductor aleatorio
        $pedido = Pedido::create([
            'cliente_id'=>$cliente->id,
            'conductor_id'=>$conductor->id,
            'direccion'=>$request->input('direccion'),
            'fecha_entrega'=>$request->input('fecha_entrega'),
            'hora_desde'=>$request->input('hora_desde'),
            'hora_hasta'=>$request->input('hora_hasta')
        ]);
        return response()->json(['message' => trans('mensajes.peticion_registrada')], 201);
    }


    public function listado($conductor_id, $dia=null, $mes=null, $anno=null){

        $pedidos = Pedido::where('conductor_id', $conductor_id);
        if(is_null($dia)){
            $pedidos->hoy();
        }elseif(($fecha = strtotime("$anno-$mes-$dia")) !== false){
            $pedidos->whereDate('fecha_entrega', date('Y-m-d',$fecha));
        }else{ // formato de fecha no válido
            return response()->json(['message' => trans('mensajes.fecha_erronea')], 422);
        }


        return PedidosResource::collection($pedidos->get());
    }

}
