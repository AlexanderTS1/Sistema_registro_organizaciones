<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Consulta</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto py-10 px-4">

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        <div class="bg-blue-700 text-white p-6">

            <h1 class="text-3xl font-bold">
                Resultado de Consulta
            </h1>

        </div>

        <div class="p-8">

            @if($organizacion)

                <div class="space-y-6">

                    <div>
                        <h2 class="text-xl font-bold text-gray-800">
                            Datos de la Organización
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">

                        <div>
                            <p class="text-gray-500 text-sm">
                                Código Expediente
                            </p>

                            <p class="font-semibold">
                                {{ $organizacion->codigo_expediente }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Razón Social
                            </p>

                            <p class="font-semibold">
                                {{ $organizacion->razon_social }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Tipo Organización
                            </p>

                            <p class="font-semibold">
                                {{ $organizacion->tipo_organizacion }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-500 text-sm">
                                Estado
                            </p>

                            <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">
                                {{ strtoupper($organizacion->estado) }}
                            </span>
                        </div>

                    </div>

                    <hr>

                    <div>

                        <h2 class="text-xl font-bold text-gray-800 mb-4">
                            Representante
                        </h2>

                        <div class="grid md:grid-cols-2 gap-6">

                            <div>
                                <p class="text-gray-500 text-sm">
                                    Nombre Completo
                                </p>

                                <p class="font-semibold">
                                    {{ $organizacion->representante->nombre_completo ?? 'No registrado' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-gray-500 text-sm">
                                    Correo
                                </p>

                                <p class="font-semibold">
                                    {{ $organizacion->representante->correo ?? '-' }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

            @else

                <div class="bg-red-100 border border-red-300 text-red-700 px-6 py-4 rounded-xl">

                    No se encontró ningún expediente registrado.

                </div>

            @endif

        </div>

    </div>

</div>

</body>
</html>