<?php
if (isset($_POST)) {
    $Productos = ($_POST['listFact']);
}
?>
<script>
    var Productos = <?php echo $Productos; ?>;
    console.log(Productos);
</script><?php
            ?>
<!DOCTYPE html>
<html>

<head>
    <title>Generar PDF</title>
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Generar PDF</h1>

        <form method="post" action="factura.php" class="mt-4">
            <div class="form-group">
                <label for="tipo">Tipo de documento:</label>
                <select class="form-control" name="tipo" id="tipo">
                    <option value="factura">Factura</option>
                    <option value="proforma">Proforma</option>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del cliente:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>



            <div id="productos">
            </div>

            <button type="button" class="btn btn-secondary mt-2" onclick="agregarProducto()">Agregar Producto</button>

            <div class="form-group mt-4">
                <label for="subtotal">Subtotal:</label>
                <input type="text" class="form-control" id="subtotal" readonly>
            </div>

            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" readonly>
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Generar PDF</button>

        </form>
    </div>

    <!-- Agrega el enlace al archivo JS de Bootstrap -->
    <script src="js/bootstrap.min.js"></script>/>
    <script>
        console.log(Productos)
        // Función para agregar dinámicamente más productos
        Productos.forEach(function(producto) {
            var productosDiv = document.getElementById('productos');
            var numProductos = productosDiv.childElementCount / 2 + 1;

            var productoGroup = document.createElement('div');
            productoGroup.className = 'form-group';

            var productoLabel = document.createElement('label');
            productoLabel.textContent = 'Producto ' + numProductos + ':';

            var productoInput = document.createElement('input');
            productoInput.type = 'text';
            productoInput.className = 'form-control';
            productoInput.name = 'producto[]';
            productoInput.required = true;
            productoInput.value=producto.nombreProducto+" :"+producto.nombre
            productoGroup.appendChild(productoInput);
            var cantidadGroup = document.createElement('div');
            cantidadGroup.className = 'form-row';
            var cantidadCol = document.createElement('div');
            cantidadCol.className = 'col';

            var cantidadLabel = document.createElement('label');
            cantidadLabel.textContent = 'Cantidad:';
            var cantidadInput = document.createElement('input');
            cantidadInput.type = 'number';
            cantidadInput.className = 'form-control';
            cantidadInput.name = 'cantidad[]';
            cantidadInput.required = true;
            cantidadInput.value=producto.cantidad;
            var precioCol = document.createElement('div');
            precioCol.className = 'col';

            var precioLabel = document.createElement('label');
            precioLabel.textContent = 'Precio unitario:';
            
            var precioInput = document.createElement('input');
            precioInput.type = 'number';
            precioInput.className = 'form-control';
            precioInput.name = 'precio[]';
            precioInput.step = '0.01';
            precioInput.required = true;
            precioInput.value=producto.precio/producto.cantidad
            cantidadCol.appendChild(cantidadLabel);
            cantidadCol.appendChild(cantidadInput);

            precioCol.appendChild(precioLabel);
            precioCol.appendChild(precioInput);

            productoGroup.appendChild(productoLabel);
            productoGroup.appendChild(productoInput);

            cantidadGroup.appendChild(cantidadCol);
            cantidadGroup.appendChild(precioCol);

            productosDiv.appendChild(productoGroup);
            productosDiv.appendChild(cantidadGroup);
        });

        function agregarProducto() {

            var productosDiv = document.getElementById('productos');
            var numProductos = productosDiv.childElementCount / 2 + 1;

            var productoGroup = document.createElement('div');
            productoGroup.className = 'form-group';

            var productoLabel = document.createElement('label');
            productoLabel.textContent = 'Producto ' + numProductos + ':';

            var productoInput = document.createElement('input');
            productoInput.type = 'text';
            productoInput.className = 'form-control';
            productoInput.name = 'producto[]';
            productoInput.required = true;

            productoGroup.appendChild(productoInput);
            var cantidadGroup = document.createElement('div');
            cantidadGroup.className = 'form-row';
            var cantidadCol = document.createElement('div');
            cantidadCol.className = 'col';

            var cantidadLabel = document.createElement('label');
            cantidadLabel.textContent = 'Cantidad:';
            var cantidadInput = document.createElement('input');
            cantidadInput.type = 'number';
            cantidadInput.className = 'form-control';
            cantidadInput.name = 'cantidad[]';
            cantidadInput.required = true;
            var precioCol = document.createElement('div');
            precioCol.className = 'col';

            var precioLabel = document.createElement('label');
            precioLabel.textContent = 'Precio unitario:';

            var precioInput = document.createElement('input');
            precioInput.type = 'number';
            precioInput.className = 'form-control';
            precioInput.name = 'precio[]';
            precioInput.step = '0.01';
            precioInput.required = true;

            cantidadCol.appendChild(cantidadLabel);
            cantidadCol.appendChild(cantidadInput);

            precioCol.appendChild(precioLabel);
            precioCol.appendChild(precioInput);

            productoGroup.appendChild(productoLabel);
            productoGroup.appendChild(productoInput);

            cantidadGroup.appendChild(cantidadCol);
            cantidadGroup.appendChild(precioCol);

            productosDiv.appendChild(productoGroup);
            productosDiv.appendChild(cantidadGroup);


        }
    </script>
</body>

</html>