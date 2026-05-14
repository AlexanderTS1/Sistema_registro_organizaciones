<h2>Estado de Expediente</h2>

<p>
    Su expediente ha sido actualizado.
</p>

<p>
    <strong>Código:</strong>
    {{ $organizacion->codigo_expediente }}
</p>

<p>
    <strong>Estado:</strong>
    {{ strtoupper($organizacion->estado) }}
</p>

@if($organizacion->observaciones)
    <p>
        <strong>Observaciones:</strong><br>
        {{ $organizacion->observaciones }}
    </p>
@endif