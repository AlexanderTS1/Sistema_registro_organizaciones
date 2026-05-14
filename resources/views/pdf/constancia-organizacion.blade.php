<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 60px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .titulo {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }

        .contenido {
            font-size: 16px;
            line-height: 1.8;
            text-align: justify;
        }

        .codigo {
            margin-top: 20px;
            font-weight: bold;
        }

        .firma {
            margin-top: 80px;
            text-align: center;
        }

    </style>
</head>
<body>

    <div class="header">

        <h2>MUNICIPALIDAD PROVINCIAL DE CALCA</h2>
        <h3>Oficina de Particiapación Vecinal - OPAVEC</h3>
        <div class="titulo">
            CONSTANCIA DE REGISTRO DE ORGANIZACIÓN
        </div>

    </div>

    <div class="contenido">

        Se deja constancia que la organización:

        <strong>
            {{ $organizacion->razon_social }}
        </strong>

        ha sido evaluada y cumple con los requisitos establecidos para su registro.

        Asimismo, se informa que el expediente:

        <strong>
            {{ $organizacion->codigo_expediente }}
        </strong>

        ha sido APROBADO satisfactoriamente.

        <div class="codigo">
            Código de Constancia:
            {{ $constancia->codigo_constancia }}
        </div>

    </div>

    <div class="firma">

        ________________________________

        <br><br>

        Oficina de Participación Vecinal- OPAVEC

    </div>

</body>
</html>