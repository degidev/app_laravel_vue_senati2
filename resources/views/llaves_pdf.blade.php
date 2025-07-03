<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Llaves</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Listado de Llaves</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($llaves as $llave)
                <tr>
                    <td>{{ $llave->id_llave }}</td>
                    <td>{{ $llave->codigo ?? '' }}</td>
                    <td>{{ $llave->disponible ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
