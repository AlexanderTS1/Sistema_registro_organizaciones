<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, sans-serif; background: #f5f5f5; padding: 30px;">

<div style="
    max-width: 600px;
    margin: auto;
    background: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.08);
">

    <h2 style="color: #1d4ed8;">
        Estado de Expediente
    </h2>

    <p>
        Su expediente ha sido actualizado correctamente.
    </p>

    <p>
        <strong>Código de Expediente:</strong><br>
        {{ $organizacion->codigo_expediente }}
    </p>

    <p>
        <strong>Estado Actual:</strong><br>
        {{ strtoupper($organizacion->estado) }}
    </p>

    @if($organizacion->observaciones)

        <div style="
            background: #fef3c7;
            border: 1px solid #fcd34d;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        ">

            <strong>Observaciones:</strong><br><br>

            {{ $organizacion->observaciones }}

        </div>

    @endif

    <div style="margin-top: 35px;">

        <a href="{{ url('/consulta-expediente') }}"
           style="
                background: #1d4ed8;
                color: white;
                padding: 14px 24px;
                text-decoration: none;
                border-radius: 8px;
                font-weight: bold;
                display: inline-block;
           ">

            Hacer Seguimiento del Expediente

        </a>

    </div>

    <p style="margin-top: 35px; color: #666;">
        Gracias por utilizar la plataforma.
    </p>

</div>

</body>
</html>