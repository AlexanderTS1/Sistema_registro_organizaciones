<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro Exitoso</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

<div class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden">

    <div class="bg-green-600 text-white p-8 text-center">

        <h1 class="text-4xl font-bold">
            Registro Exitoso
        </h1>

        <p class="mt-3 text-green-100">
            Su organización fue registrada correctamente.
        </p>

    </div>

    <div class="p-8 text-center">

        <div class="bg-gray-100 rounded-2xl p-6 mb-6">

            <p class="text-gray-600 text-lg">
                Número de Expediente
            </p>

            <h2 class="text-3xl font-bold text-blue-700 mt-2">
                {{ $organizacion->codigo_expediente }}
            </h2>

        </div>

        <div class="space-y-3 text-gray-700">

            <p>
                <strong>Organización:</strong>
                {{ $organizacion->razon_social }}
            </p>

            <p>
                <strong>Estado:</strong>
                {{ strtoupper($organizacion->estado) }}
            </p>

            <p>
                Se notificó automáticamente al correo del representante.
            </p>

        </div>

        <div class="mt-8">

            <a href="{{ url('/consulta-expediente') }}"
               class="bg-blue-700 hover:bg-blue-800 transition text-white px-8 py-3 rounded-xl inline-block">

                Consultar Expediente

            </a>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
Swal.fire({
    icon: 'success',
    title: 'Registro Exitoso',
    html: `
        <strong>Expediente:</strong><br>
        {{ $organizacion->codigo_expediente }}
    `,
    confirmButtonText: 'Aceptar'
})
</script>
</body>
</html>