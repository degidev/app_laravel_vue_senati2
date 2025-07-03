<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Llaves</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
        }
        h1 {
            color: #2b2b2b;
            text-align: center;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        p {
            text-align: center;
            margin-bottom: 25px;
            color: #555;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }
        th, td {
            border: 1px solid #d3d3d3;
            padding: 10px 8px;
            text-align: left;
            font-size: 13px;
        }
        th {
            background: #3b82f6;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tr:nth-child(even) {
            background: #f1f5fa;
        }
        tr:hover {
            background: #e0e7ef;
        }
    </style>
</head>
<body>
    <h1>Lista de Llaves</h1>
    <p>Diego Lipa</p>
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Disponible</th>
                <th>Estado</th>
                <th>Orden</th>
            </tr>
        </thead>
        <tbody>
            @foreach($llaves as $llave)
            <tr>
                <td>{{ $llave->codigo }}</td>
                <td>{{ $llave->disponible }}</td>
                <td>{{ $llave->estado }}</td>
                <td>{{ $llave->orden }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
