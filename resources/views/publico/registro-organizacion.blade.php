<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Organización</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen">
@if ($errors->any())

<div class="max-w-4xl mx-auto mt-6">

    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl">

        <strong>Errores encontrados:</strong>

        <ul class="mt-3 list-disc list-inside">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

</div>

@endif
<div class="py-10 px-4">

    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">

        <div class="bg-blue-700 text-white p-6 md:p-8">

            <h1 class="text-3xl md:text-4xl font-bold">
                Registro de Organización
            </h1>

            <p class="mt-2 text-blue-100 text-sm md:text-base">
                Plataforma de inscripción de organizaciones sociales.
            </p>

        </div>

        <div class="p-6 md:p-10">

            <form action="{{ route('registro.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-10">

                @csrf

                {{-- REPRESENTANTE --}}
                <div>

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Datos del Representante
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block mb-2 font-medium">
                                DNI
                            </label>

                            <input type="text"
                                   name="dni"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Nombres
                            </label>

                            <input type="text"
                                   name="nombres"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Apellidos
                            </label>

                            <input type="text"
                                   name="apellidos"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Correo Electrónico
                            </label>

                            <input type="email"
                                   name="correo"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Teléfono
                            </label>

                            <input type="text"
                                   name="telefono"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Domicilio
                            </label>

                            <input type="text"
                                   name="domicilio"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Distrito
                            </label>

                            <input type="text"
                                   name="distrito"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Provincia
                            </label>

                            <input type="text"
                                   name="provincia"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">
                                Departamento
                            </label>

                            <input type="text"
                                   name="departamento"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                    </div>

                </div>

                {{-- ORGANIZACION --}}
                <div>

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Datos de la Organización
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block mb-2 font-medium">
                                Tipo Organización
                            </label>

                            <select name="tipo_organizacion"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                    required>

                                <option value="">Seleccione</option>
                                <option value="social">Social</option>
                                <option value="base">Base</option>
                                <option value="comunal">Comunal</option>
                                <option value="vecinal">Vecinal</option>
                                <option value="cultural">Cultural</option>
                                <option value="regantes">Regantes</option>
                                <option value="otros">Otros</option>

                            </select>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Razón Social
                            </label>

                            <input type="text"
                                   name="razon_social"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                   required>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-2 font-medium">
                                Dirección
                            </label>

                            <input type="text"
                                   name="direccion"
                                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                    </div>

                </div>

                {{-- DOCUMENTOS --}}
                <div>

                    <h2 class="text-2xl font-bold text-gray-800 mb-6">
                        Documentos PDF
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <div>
                            <label class="block mb-2 font-medium">
                                Acta de Constitución
                            </label>

                            <input type="file"
                                   name="acta_constitucion"
                                   class="w-full border border-gray-300 rounded-xl p-3"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Padrón de Socios
                            </label>

                            <input type="file"
                                   name="padron_socios"
                                   class="w-full border border-gray-300 rounded-xl p-3"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Acta de Elección Directiva
                            </label>

                            <input type="file"
                                   name="acta_eleccion_directiva"
                                   class="w-full border border-gray-300 rounded-xl p-3"
                                   required>
                        </div>

                        <div>
                            <label class="block mb-2 font-medium">
                                Partida Registral
                            </label>

                            <input type="file"
                                   name="partida_registral"
                                   class="w-full border border-gray-300 rounded-xl p-3">
                        </div>
                        <div id="campoResolucionANA" class="hidden">
                            <label class="block mb-2 font-medium">
                                Resolución de Reconocimiento emitida por ANA
                            </label>

                            <input type="file"
                                name="resolucion_ana"
                                accept=".pdf"
                                class="w-full border border-gray-300 rounded-xl p-3">
                        </div>

                    </div>

                </div>

                <div class="pt-4">

                    <button type="submit"
                            class="w-full md:w-auto bg-blue-700 hover:bg-blue-800 transition text-white font-semibold px-10 py-4 rounded-xl">

                        Registrar Organización

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<script>

    const tipoOrganizacion = document.querySelector(
        'select[name="tipo_organizacion"]'
    );

    const campoANA = document.getElementById(
        'campoResolucionANA'
    );

    function toggleCampoANA() {

        if (tipoOrganizacion.value === 'regantes') {

            campoANA.classList.remove('hidden');

        } else {

            campoANA.classList.add('hidden');

        }
    }

    tipoOrganizacion.addEventListener(
        'change',
        toggleCampoANA
    );

    toggleCampoANA();

</script>
</body>
</html>