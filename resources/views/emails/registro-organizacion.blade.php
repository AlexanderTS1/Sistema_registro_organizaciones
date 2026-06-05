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
        Registro Exitoso
    </h2>

    <p>
        Su organización fue registrada correctamente.
    </p>

    <p>
        <strong>Número de expediente:</strong><br>
        {{ $organizacion->codigo_expediente }}
    </p>

    <p>
        <strong>Estado actual:</strong><br>
        {{ strtoupper($organizacion->estado) }}
    </p>

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