<div>
    <div class="d-flex p-2 justify-content-center">
        <h2 class="centrar-texto">Ventas nacionales</h2>
    </div>
    <div>
        <style type="text/css">
            table td,
            table th {
                border: 1px solid black;
            }
        </style>
        <table>
            <thead>

                <tr>
                    <th scope="col">ID_TRANSACCION</th>
                    <th scope="col">ID_PEDIDO</th>
                    <th scope="col">VENDEDOR</th>
                    <th scope="col">COMPRADOR</th>
                    <th scope="col">FECHA TRANSACCIÓN</th>
                    <th scope="col">NOMBRE FRUTA</th>
                    <th scope="col">CALIDAD</th>
                    <th scope="col">CANTIDAD</th>
                    <th scope="col">SUBTOTAL VENTA</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reportes as $reporte)
                <tr>
                    <td>{{$reporte->ID_TRANSACCION}}</td>
                    <td>{{$reporte->ID_PEDIDO}}</td>
                    <td>{{$reporte->CORREO_VENDEDOR}}</td>
                    <td>{{$reporte->CORREO_COMPRADOR}}</td>
                    <td>{{$reporte->FECHA_TRANSACCION}}</td>
                    <td>{{$reporte->NOMBRE_FRUTA}}</td>
                    <td>{{$reporte->TIPO_CALIDAD}}</td>
                    <td>{{$reporte->CANT_KG}}</td>
                    <td>{{$reporte->SUBTOTAL_TRANSACCION}}</td>
                    @endforeach
            </tbody>
        </table>
    </div>
    <a href="{{route('imprimir',['download'=>'PDF'])}}">Imprimir Reporte</a>

</div>