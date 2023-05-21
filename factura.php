<?php
require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $tipo = $_POST['tipo'];
    $nombre = $_POST['nombre'];
    $productos = $_POST['producto'];
    $cantidades = $_POST['cantidad'];
    $precios = $_POST['precio'];
    // Crear una instancia de Dompdf
    $dompdf = new Dompdf();

    // Construir el contenido HTML
    ob_start();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 10px;
                border: 2px solid #000;
                padding: 10px;
            }

            h1 {
                text-align: center;
                text-transform: uppercase;
                font-size: 30px;
                margin-bottom: 10px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
            }

            th,
            td {
                border: 1px solid #000;
                padding: 8px;
            }

            th {
                background-color: #343a40;
                color: #fff;
                font-weight: bold;
            }

            td {
                background-color: #f8f9fa;
            }

            .subtotal {
                font-weight: bold;
                font-size: 18px;
            }
            .bx-e{
                padding:5px;
                padding-left: 10px;
                background-color: #808386d2;
                width: 40%;
            }
            p>span{
                font-weight: bolder;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1><?php echo strtoupper($tipo); ?></h1>
            <div class="bx-e">
                <p><span>EMPRESA:</span>  VICO DIESEL</p>
                <p><span>DIRECCION</span> : CEJA CALLE 6</p>
                <p><span>CELULAR</span> : +591 73258781</p>
                <p><span>CIUDAD</span> : EL ALTO - LA PAZ</p>
            </div>
            <h2>DATOS DEL CLIENTE</h2>
            <p><span>NOMBRE:</span>  <?php echo $nombre; ?></p>
            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unit(Bs.)</th>
                        <th>Subtotal(Bs.)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Calcular el subtotal y generar las filas de productos
                    $subtotal = 0;
                    for ($i = 0; $i < count($productos); $i++) {
                        $producto = $productos[$i];
                        $cantidad = $cantidades[$i];
                        $precio = $precios[$i];
                        $subtotalProducto = $cantidad * $precio;
                        $subtotal += $subtotalProducto;
                    ?>
                        <tr>
                            <td><?php echo $producto; ?></td>
                            <td><?php echo $cantidad; ?></td>
                            <td><?php echo $precio; ?></td>
                            <td><?php echo $subtotalProducto; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <p class="subtotal">Subtotal: $<?php echo $subtotal; ?></p>
        </div>
    </body>

    </html>
<?php
    // Obtener el contenido del búfer de salida
    $html = ob_get_clean();
    $dompdf->loadHtml($html);
    // Renderizar el PDF
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // Mostrar el PDF en el navegador
    $dompdf->stream('factura.pdf', ['Attachment' => false]);
}
?>