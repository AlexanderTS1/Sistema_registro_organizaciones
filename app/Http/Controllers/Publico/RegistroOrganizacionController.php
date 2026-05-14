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

            'dni' => 'required|digits:8',
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'correo' => 'required|email|max:255',

            'tipo_organizacion' => 'required',
            'razon_social' => 'required|string|max:255',

            'acta_constitucion' => 'required|mimes:pdf|max:5120',
            'padron_socios' => 'required|mimes:pdf|max:5120',
            'acta_eleccion_directiva' => 'required|mimes:pdf|max:5120',
            'partida_registral' => 'nullable|mimes:pdf|max:5120',
        ]);

        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | 1. CREAR ORGANIZACION
            |--------------------------------------------------------------------------
            */

            $organizacion = Organizacion::create([

                'tipo_organizacion' => $request->tipo_organizacion,

                'razon_social' => $request->razon_social,

                'direccion' => $request->direccion,

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
            | 2. CREAR PERSONA
            |--------------------------------------------------------------------------
            */

            $persona = Persona::create([

                'organizacion_id' => $organizacion->id,

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
            | 3. ACTUALIZAR REPRESENTANTE
            |--------------------------------------------------------------------------
            */

            $organizacion->update([
                'representante_id' => $persona->id
            ]);

            DB::commit();

            /*
            |--------------------------------------------------------------------------
            | 4. CORREO
            |--------------------------------------------------------------------------
            */

            try {

                Mail::to($persona->correo)
                    ->send(new RegistroOrganizacionMail($organizacion));

            } catch (\Exception $mailError) {

            }

            /*
            |--------------------------------------------------------------------------
            | 5. REDIRECT
            |--------------------------------------------------------------------------
            */

            return redirect()->route(
                'registro.success',
                $organizacion->id
            );

        } catch (\Exception $e) {

            DB::rollBack();

            dd($e->getMessage());

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