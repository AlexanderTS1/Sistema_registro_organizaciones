<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Expediente</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl overflow-hidden">

            <div class="bg-blue-700 text-white p-6 md:p-8">

                <h1 class="text-2xl md:text-4xl font-bold">
                    Consulta de Expediente
                </h1>

                <p class="mt-2 text-blue-100 text-sm md:text-base">
                    Consulte el estado de registro de su organización.
                </p>

            </div>

            <div class="p-6 md:p-10">

                <form action="{{ route('consulta.buscar') }}"
                      method="POST"
                      class="space-y-6">

                    @csrf

                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Código de Expediente
                        </label>

                        <input
                            type="text"
                            name="codigo_expediente"
                            placeholder="Ejemplo: ORG-2026-00001"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required
                        >

                    </div>

                    <button
                        type="submit"
                        class="w-full bg-blue-700 hover:bg-blue-800 transition text-white font-semibold py-3 rounded-xl"
                    >
                        Consultar Expediente
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>
</html>