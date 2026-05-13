<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<h2>Registro Exitoso</h2>

<p>
    Su organización fue registrada correctamente.
</p>

<p>
    <strong>Número de expediente:</strong>
    {{ $organizacion->codigo_expediente }}
</p>

<p>
    Estado actual:
    {{ strtoupper($organizacion->estado) }}
</p>

<p>
    Gracias por utilizar la plataforma.
</p>

</body>
</html>