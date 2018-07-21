<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiPedidoRequest;
use App\Http\Requests\PedidoRequest;
use Illuminate\Http\Request;

use App\Http\Resources\PedidoResource;
use App\Http\Resources\PedidosResource;

use App\Conductor;
use App\Cliente;
use App\Pedido;

class PedidoController extends Controller
{
    /******************************** funciones de la API  **********************************/
    public function nuevo(ApiPedidoRequest $request)
    {
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


    public function listado($token, $dia=null, $mes=null, $anno=null)
    {
        $conductor = Conductor::whereToken($token)->first();

        if(!$conductor){ // no existe el conductor
            return response()->json(['message' => trans('mensajes.no_conductor')], 422);
        }

        $pedidos = Pedido::where('conductor_id', $conductor->id);
        if(is_null($dia)){
            $pedidos->hoy();
        }elseif(($fecha = strtotime("$anno-$mes-$dia")) !== false){
            $pedidos->whereDate('fecha_entrega', date('Y-m-d',$fecha));
        }else{ // formato de fecha no válido
            return response()->json(['message' => trans('mensajes.fecha_erronea')], 422);
        }

        return PedidosResource::collection($pedidos->get());
    }



    /**************************  funciones del panel ******************************/

    public function index()
    {
        return view('home')->with('peticiones', Pedido::paginate(10))
                                ->with('conductores', Conductor::orderBy('nombre')->get());
    }


    public function show($id)
    {
        $pedido = Pedido::find($id);
        if($pedido){
            return new PedidoResource($pedido);
        }else{
            return response()->json(['result'=>false, 'message'=>trans('panel.no_pedido')], 422);
        }
    }

    public function action(PedidoRequest $request){

        $pedido = Pedido::find($request->input('id'));

        if(!$pedido) return response()->json(['result'=>false, 'message'=>trans('panel.no_pedido')], 422);

        if ($request->input('accion') == 'delete'){
            $pedido->delete();
            return response()->json(['result'=>true, 'message'=>trans('panel.pedido_delete')]);
        }else{
            $pedido->direccion = $request->input('direccion');
            $pedido->conductor_id = $request->input('conductor_id');
            $pedido->fecha_entrega = $request->input('fecha_entrega');
            $pedido->hora_desde = $request->input('hora_desde');
            $pedido->hora_hasta = $request->input('hora_hasta');
            $pedido->save();
            return response()->json(['result'=>true, 'message'=>trans('panel.pedido_save')]);
        }
    }

}
