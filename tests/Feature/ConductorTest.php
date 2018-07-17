<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConductorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


    /* comprobación del listado de peticiones diarias del conductor */
    public function testListado()
    {
        $this->json('get', '/api/pedidos/2')
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    0=>[
                        'nombre',
                        'apellidos',
                        'email',
                        'telefono',
                        'direccion',
                        'hora_desde',
                        'hora_hasta',
                    ]
                ],
            ]);
    }


    /* comprobación del registro no mandando datos para comprobar que funciona la validación */
    public function testRegistroFallido()
    {
        $payload = []; // mandamos los datos del formulario vacios para comprobar que saltan los erroress

        $this->json('post', '/api/pedido', $payload)
            ->assertStatus(422)
            ->assertJson([
                'message'=>"The given data was invalid.",
                'errors' => [
                               'nombre'=>[trans('validation.required', ['attribute'=>'nombre'])],
                               'apellidos'=>[trans('validation.required', ['attribute'=>'apellidos'])],
                               'email'=>[trans('validation.required', ['attribute'=>'email'])],
                ]
            ]);
    }


    /* comprobación del registro que funciona correctamente */
    public function testRegistroCorrecto()
    {
        $payload = [
            'nombre'=>'Tomás J.',
            'apellidos'=>'Rodríguez Martínez',
            'email'=>'info@ertomy.es',
            'telefono'=>'987654321',
            'direccion'=>'mi dirección',
            'fecha_entrega'=>date('d/m/Y'),
            'hora_desde'=>10,
            'hora_hasta'=>12,
        ];

        $this->json('post', '/api/pedido', $payload)
            ->assertStatus(201)
            ->assertJson([
                'message' => trans('mensajes.peticion_registrada'),
            ]);
    }



}
