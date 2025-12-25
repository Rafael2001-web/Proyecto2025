<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        padding: 20xp;
    }
    h1{
        text-aling: center;
        color: #333333;
    }
    table{
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0,0,0,0.1)
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-aling: left;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #e9e9e9;
    }
    </style>

    <h1>Listado de ODS</h1>
    {{-- Tabla para listar todas los ODS --}}

    <table style="background-color: #f8f8fa;">

        <thead>
            <tr>
                <th style="border: 1px solid #4550eb; padding: 8px">ID</th>
                <th style="border: 1px solid #4550eb; padding: 8px">ODS num</th>
                <th style="border: 1px solid #4550eb; padding: 8px">Nombre</th>
                <th style="border: 1px solid #4550eb; padding: 8px">Descripción</th>
            </tr>
        </thead>
        <tbody>

            @foreach($ods as $ods)
                <tr>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$ods->idOds}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$ods->odsnum}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$ods->nombre}}</td>
                    <td style="border: 1px solid #ccc; padding: 8px">{{$ods->descripcion}}</td>
                </tr>
            @endforeach

        </tbody>

    </table>
