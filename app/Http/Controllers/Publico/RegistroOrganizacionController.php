<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroOrganizacionMail;

class RegistroOrganizacionController extends Controller
{
    /**
     * FORMULARIO DE REGISTRO
     */
    public function create()
    {
        return view('publico.registro-organizacion');
    }

    /**
     * GUARDAR REGISTRO
     */
    public function store(Request $request)
    {
        $request->validate([

            /*
            |--------------------------------------------------------------------------
            | DATOS REPRESENTANTE
            |--------------------------------------------------------------------------
            */

            'dni' => 'required|digits:8',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo' => 'required|email|max:255',

            /*
            |--------------------------------------------------------------------------
            | DATOS ORGANIZACION
            |--------------------------------------------------------------------------
            */

            'tipo_organizacion' => 'required',
            'razon_social' => 'required|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | DOCUMENTOS
            |--------------------------------------------------------------------------
            */

            'acta_constitucion' => 'required|mimes:pdf|max:5120',
            'padron_socios' => 'required|mimes:pdf|max:5120',
            'acta_eleccion_directiva' => 'required|mimes:pdf|max:5120',
            'partida_registral' => 'nullable|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1. CREAR PERSONA
            |--------------------------------------------------------------------------
            */

            $persona = Persona::create([

                'dni' => $request->dni,
                'nombres' => $request->nombres,
                'apellidos' => $request->apellidos,

                'domicilio' => $request->domicilio,
                'distrito' => $request->distrito,
                'provincia' => $request->provincia,
                'departamento' => $request->departamento,

                'telefono' => $request->telefono,
                'correo' => $request->correo,
            ]);



            /*
            |--------------------------------------------------------------------------
            | 2. CREAR ORGANIZACION
            |--------------------------------------------------------------------------
            */

            $organizacion = Organizacion::create([

                'tipo_organizacion' => $request->tipo_organizacion,

                'razon_social' => $request->razon_social,

                'direccion' => $request->direccion,

                'representante_id' => $persona->id,

                'estado' => 'registrado',

                'acta_constitucion' => $request
                    ->file('acta_constitucion')
                    ->store('documentos', 'public'),

                'padron_socios' => $request
                    ->file('padron_socios')
                    ->store('documentos', 'public'),

                'acta_eleccion_directiva' => $request
                    ->file('acta_eleccion_directiva')
                    ->store('documentos', 'public'),

                'partida_registral' => $request->hasFile('partida_registral')
                    ? $request->file('partida_registral')
                        ->store('documentos', 'public')
                    : null,
            ]);



            /*
            |--------------------------------------------------------------------------
            | 3. CONFIRMAR TRANSACCION
            |--------------------------------------------------------------------------
            */

            DB::commit();



            /*
            |--------------------------------------------------------------------------
            | 4. ENVIAR CORREO
            |--------------------------------------------------------------------------
            */

            try {

                Mail::to($persona->correo)
                    ->send(new RegistroOrganizacionMail($organizacion));

            } catch (\Exception $mailError) {

                // evita que falle el registro por correo
            }



            /*
            |--------------------------------------------------------------------------
            | 5. REDIRECCIONAR
            |--------------------------------------------------------------------------
            */

            return redirect()->route(
                'registro.success',
                $organizacion->id
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Error: ' . $e->getMessage()
                );
        }
    }

    /**
     * REGISTRO EXITOSO
     */
    public function success($id)
    {
        $organizacion = Organizacion::with('representante')
            ->findOrFail($id);

        return view(
            'publico.registro-exitoso',
            compact('organizacion')
        );
    }

    /**
     * CONSULTA DE EXPEDIENTE
     */
    public function consulta()
    {
        return view('publico.consulta-expediente');
    }

    /**
     * BUSCAR EXPEDIENTE
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'codigo_expediente' => 'required',
        ]);

        $organizacion = Organizacion::with('representante')
            ->where(
                'codigo_expediente',
                $request->codigo_expediente
            )
            ->first();

        return view(
            'publico.resultado-expediente',
            compact('organizacion')
        );
    }
}