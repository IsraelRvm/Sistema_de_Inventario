<?php include("conexion.php"); ?>
<script>
  mostrar = false;
  var actualizar = false;
  var Productos = [];
</script>
<?php
//DEBES CREAR UNA CARPETA CON PERMISOS DE ESCRITURA E LECTURA
$opciones;
$opc;
$objConexion = new conexion();
$opciones = $objConexion->NombresDeProductos("SELECT * FROM `configuraciones`");

if ($_POST) {
  $opc = $_POST['opc'];
  switch ($opc) {
    case 1:
      if (isset($_POST['Nombre'])) {
        $Nombre = $_POST['Nombre'];
      } else {
        $Nombre = "";
      }
      $Codigo = $_POST['Codigo'];
      $Marca = $_POST['Marca'];
      $Detalles = $_POST['Detalles'];
      $Coche = $_POST['Coche'];
      $PrecioCompraB = $_POST['PrcCB'];
      $PrecioVentaB = $_POST['PrcVB'];
      $PrecioCompraD = $_POST['PrcCD'];
      $PrecioVentaD = $_POST['PrcVD'];
      $Proveedor = $_POST['Proveedor'];
      $fecha = new DateTime();
      $imagen = $fecha->getTimestamp() . "_" . $_FILES['imagen']['name'];
      $imagen_temporal = $_FILES['imagen']['tmp_name'];
      // Verificar si el producto ya existe en la lista de productos
      if (isset($_SESSION['productos']) && in_array($Codigo, $_SESSION['productos']) && in_array($Marca, $_SESSION['marca'])) {
        // El producto ya existe, no lo agregamos nuevamente
      } else {
        // Agregar el producto a la base de datos y a la lista de productos
        if (!in_array(strtoupper($Nombre), $opciones)) {
          $objConexion->ejecutar("INSERT INTO `configuraciones` (`ID`, `Nombre`) VALUES (NULL, '$Nombre');");
        }
        $sql = "INSERT INTO `productos` (`ID`, `Nombre`, `img`, `Codigo`, `Marca`, `Coche`, `Detalles`, `PrecioCompraD`, `PrecioVentaD`, `PrecioCompraB`, `PrecioVentaB`, `Proveedor`) VALUES (NULL, '$Nombre', '$imagen', '$Codigo', '$Marca', '$Coche', '$Detalles', '$PrecioCompraD', '$PrecioVentaD', '$PrecioCompraB', '$PrecioVentaB', '$Proveedor')";

        $objConexion->ejecutar($sql);
        // Guardar el código del producto en la lista de productos
        $_SESSION['productos'][] = $Codigo;
        $_SESSION['marca'][] = $Marca;
        move_uploaded_file($imagen_temporal, "imgs/" . $imagen);
?>
        <script>
          mostrar = true;
        </script>
      <?php
      }
      break;
    case 2:
      if (isset($_POST['Nombre'])) {
        $Nombre = $_POST['Nombre'];
      } else {
        $Nombre = "";
      }

      $Codigo = $_POST['Codigo'];
      $Marca = $_POST['Marca'];
      $Detalles = $_POST['Detalles'];
      $Coche = $_POST['Coche'];
      $PrecioCompraB = $_POST['PrcCB'];
      $PrecioVentaB = $_POST['PrcVB'];
      $PrecioCompraD = $_POST['PrcCD'];
      $PrecioVentaD = $_POST['PrcVD'];
      $Proveedor = $_POST['Proveedor'];
      $ID = $_POST['id'];
      if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // El archivo se cargó correctamente
        $fecha = new DateTime();
        $imagen = $fecha->getTimestamp() . "_" . $_FILES['imagen']['name'];
        $imagen_temporal = $_FILES['imagen']['tmp_name'];
        $sql = "UPDATE `productos` SET `Codigo` = '$Codigo', `Marca` = '$Marca', `Detalles` = '$Detalles', `Nombre` = '$Nombre', `Coche` = '$Coche', `PrecioCompraD` = '$PrecioCompraD', `PrecioVentaD` = '$PrecioVentaD', `PrecioCompraB` = '$PrecioCompraB', `PrecioVentaB` = '$PrecioVentaB',`img` = '$imagen'  , `Proveedor` = '$Proveedor' WHERE `productos`.`ID` = $ID;";
        $objConexion->ejecutar($sql);
        move_uploaded_file($imagen_temporal, "imgs/" . $imagen);
      } else {
        $sql = "UPDATE `productos` SET `Codigo` = '$Codigo', `Marca` = '$Marca', `Detalles` = '$Detalles', `Nombre` = '$Nombre', `Coche` = '$Coche', `PrecioCompraD` = '$PrecioCompraD', `PrecioVentaD` = '$PrecioVentaD', `PrecioCompraB` = '$PrecioCompraB', `PrecioVentaB` = '$PrecioVentaB', `Proveedor` = '$Proveedor' WHERE `productos`.`ID` = $ID;";
        $objConexion->ejecutar($sql);
      }

      break;
    case 3:
      if (isset($_POST['nombreText'])) {
        $Nombre = $_POST['nombreText'];
      } else {
        $Nombre = "";
      }
      $Codigo = $_POST['Codigo'];
      $Marca = $_POST['Marca'];
      $Detalles = $_POST['Detalles'];
      $Coche = $_POST['Coche'];
      $PrecioCompraB = $_POST['PrcCB'];
      $PrecioVentaB = $_POST['PrcVB'];
      $PrecioCompraD = $_POST['PrcCD'];
      $PrecioVentaD = $_POST['PrcVD'];
      $Proveedor = $_POST['Proveedor'];
      $fecha = new DateTime();
      $imagen = $fecha->getTimestamp() . "_" . $_FILES['imagen']['name'];
      $imagen_temporal = $_FILES['imagen']['tmp_name'];
      // Verificar si el producto ya existe en la lista de productos
      if (isset($_SESSION['productos']) && in_array($Codigo, $_SESSION['productos']) && in_array($Marca, $_SESSION['marca'])) {
        // El producto ya existe, no lo agregamos nuevamente
      } else {
        $objConexion->ejecutar("INSERT INTO `configuraciones` (`ID`, `Nombre`) VALUES (NULL, '$Nombre');");
        $sql = "INSERT INTO `productos` (`ID`, `Nombre`, `img`, `Codigo`, `Marca`, `Coche`, `Detalles`, `PrecioCompraD`, `PrecioVentaD`, `PrecioCompraB`, `PrecioVentaB`, `Proveedor`) VALUES (NULL, '$Nombre', '$imagen', '$Codigo', '$Marca', '$Coche', '$Detalles', '$PrecioCompraD', '$PrecioVentaD', '$PrecioCompraB', '$PrecioVentaB', '$Proveedor')";
        $objConexion->ejecutar($sql);
        // Guardar el código del producto en la lista de productos
        $_SESSION['productos'][] = $Codigo;
        $_SESSION['marca'][] = $Marca;
        move_uploaded_file($imagen_temporal, "imgs/" . $imagen);
      ?>
        <script>
          mostrar = true;
        </script>
<?php
      }
      break;
    case 4:
      $id = $_POST['ID'];
      if (isset($_SESSION['id'])) {
        if (in_array($id, $_SESSION['id'])) {
        } else {
          $imagen = $objConexion->consultar("SELECT img FROM `productos` WHERE id=" . $id);
          $objConexion->ejecutar("DELETE FROM productos WHERE `productos`.`ID` = $id");
          $archivo = "imgs/" . $imagen[0]['img'];
          if (file_exists($archivo)) {
            unlink("imgs/" . $imagen[0]['img']);
          }
          $_SESSION['id'][] = $id;
        }
      } else {
        $imagen = $objConexion->consultar("SELECT img FROM `productos` WHERE id=" . $id);
        $objConexion->ejecutar("DELETE FROM productos WHERE `productos`.`ID` = $id");
        $archivo = "imgs/" . $imagen[0]['img'];
        if (file_exists($archivo)) {
          if (is_file($archivo)) {

            unlink("imgs/" . $imagen[0]['img']);
          }
        }
        $_SESSION['id'][] = $id;
      }

      break;
  }
} else {
  $opc = 1;
}
$opciones = $objConexion->NombresDeProductos("SELECT * FROM `configuraciones`");
$resultado = $objConexion->consultar("SELECT * FROM `productos`");
$productos_json = json_encode($resultado);
?>
<script>
  var Productos = <?php echo $productos_json; ?>;
  console.log(Productos)
</script><?php
          /*
CODIGO PARA BORRAR
$imagen=$objConexion->consultar("SELECT img FROM `productos` WHERE id=".$id);
unlink("imgs/".$imagen[0]['img'])
*/
          ?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inventario</title>
  <!-- BOOTSTRAP -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <!-- MI ESTILO   -->
  <link rel="stylesheet" href="myCss/style.css" />
  <!-- ICONOS -->
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css" />
</head>

<body>

  <nav class="navbar bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="imgs/Vlogo.png" alt="Logo" width="50" height="44" class="d-inline-block align-text-top" />
        <span class="title">Vico Diesel - Repuestos electricos</span>
      </a>
    </div>
  </nav>
  <div class="BoxFull">
    <div class="Menu">
      <!-- Agregar HTML para el tostador -->

      <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" id="Edit" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
              <i class="bi bi-file-plus"></i><span id="ActOrAgr">Agregar producto</span>
            </button>
          </h2>
          <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <form class="accordion-body" action="index.php" method="post" enctype="multipart/form-data" id="FormAgg">
              <div>
                <input type="text" class="form-control" name="nombreText" placeholder="" style="display:none" id="nombreText" />
                <select class="form-select mb-2" name="Nombre" id="Nombre" aria-label="Default select example">
                  <option selected>Nombre del producto</option>
                  <?php foreach ($opciones as $opcion) { ?>
                    <option value="<?php echo $opcion; ?>"><?php echo $opcion; ?></option>
                  <?php } ?>
                </select>
                <i style="font-size:30px;cursor:pointer" id="agregarNombre" class="bi bi-file-plus"></i>
              </div>

              <div class="mb-3">
                <label for="Codigo" class="form-label">Codigo</label>
                <input type="text" class="form-control" name="Codigo" placeholder="" required id="Codigo" />
              </div>
              <div class="mb-3">
                <label for="Marca" class="form-label">Marca</label>
                <input type="text" class="form-control" name="Marca" id="Marca" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="Coche" class="form-label">Coche</label>
                <input type="text" class="form-control" name="Coche" id="Coche" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="Detalles" class="form-label">Detalles</label>
                <input type="text" class="form-control" name="Detalles" id="Detalles" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="PrcC" class="form-label prc">Precio de compra Bolivianos</label>
                <input type="number" step="any" class="form-control" name="PrcCB" id="PrcCB" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="PrcC" class="form-label prc">Precio de compra Dolares</label>
                <input type="number" step="any" class="form-control" name="PrcCD" id="PrcCD" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="PrcV" class="form-label prc">Precio de venta Bolivianos</label>
                <input type="number" step="any" class="form-control" name="PrcVB" id="PrcVB" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="PrcV" class="form-label prc">Precio de venta Dolares</label>
                <input type="number" step="any" class="form-control" name="PrcVD" id="PrcVD" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="Proveedor" class="form-label">Proveedor</label>
                <input type="text" class="form-control" name="Proveedor" id="Proveedor" placeholder="" />
              </div>
              <div class="mb-3">
                <label for="imagen" class="form-label prc">Imagen</label>
                <input type="file" class="form-control" name="imagen" placeholder="" />
                <input type="hidden" name="opc" id="opc" value="1">
                <input type="hidden" name="id" id='id' value="0">
              </div>
              <input class="btn btn-primary" type="submit" id="liveToastBtn" value="AGREGAR"></input>
            </form>
          </div>
        </div>

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
              <i class="bi bi-search"></i> Búsqueda técnica
            </button>
          </h2>
          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body ab">
              <select class="form-select" aria-label="Default select example" onchange="BusquedaEspecifica()" id="Tecnica">
                <option selected>Nombre del producto</option>
                <?php foreach ($opciones as $opcion) { ?>
                  <option value="<?php echo $opcion; ?>"><?php echo $opcion; ?></option>
                <?php } ?>
              </select>

            </div>

          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              <i class="bi bi-search"></i> Búsqueda rápida
            </button>
          </h2>
          <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
            <div class="accordion-body" id="">
              <input type="text" class="form-control" name="Busqueda" placeholder="Codigo del producto" oninput="actualizarTabla(this.value)">

              <input type="hidden" name="opc" value="2">
              <button class="btn btn-primary" onclick="actualizarTabla('')" id="BtnActualizar" value="">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
        <!-- AGG/ACT -->
      <div class="d-flex flex-column justify-content-center mx-4">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
          <label class="form-check-label fw-bold" for="flexRadioDefault1">
            AGREGAR
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
          <label class="form-check-label fw-bold" for="flexRadioDefault2">
            ACTUALIZAR
          </label>
        </div>
      </div>
      <!-- LISTA PARA FACTURAR -->
      <hr>
      <?php include('listaCompra.html') ?>
    </div>
    <div id="Vista">
      <div class="Vista table-responsive">
        <div id="TablaWrapper">
          <?php if ($opc >= 1 && $opc <= 4) : include('tablaBuscaRapida.php');
          ?>
          <?php endif; ?>
        </div>
      </div>
    </div>


  </div>
  <!-- MENSAJES TOAST -->
  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-check-square-fill"></i>
        <strong class="me-auto"> SOLICITUD EXISTOSA</strong>
        <small></small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        El producto <?php echo "El producto " . $Codigo . " fue agregado exitosamente." ?>
      </div>
    </div>
  </div>
  <!-- IMAGEN MODAL -->
  <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex justify-content-center row">
          <img class="col-12" src="" id="imgModal" alt="Sin imagen" width="70%" height="70%">
          <div >
            <span class="btn btn-primary " id="resCar"><i class="bi bi-dash-circle"></i></span><input type="number" id="addCar" class="form-control fw-bolder w-25 d-inline" placeholder="0"><span class="btn btn-primary" id="sumCar"><i class="bi bi-plus-circle"></i></span> <button class="btn btn-info " data-bs-dismiss="modal" id="btnAddCar"><i class="bi bi-bag-plus-fill"></i></button>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <style>
    #addCar::-webkit-outer-spin-button,
    #addCar::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
  </style>
  <script src="js/bootstrap.min.js"></script>
  <script src="myJs/main.js"></script>
  <script>
    const sumCar = document.getElementById('sumCar')
    const resCar = document.getElementById('resCar')
    const inputCar = document.getElementById('addCar')
    const btnAddCar = document.getElementById('btnAddCar')
    var nombreProducto="";
    var CodigoF="";
    var PrecioF="";
    var CantidadF=""
    btnAddCar.addEventListener('click', () => {
      CantidadF=inputCar.value
      PrecioF=Number(PrecioF)*Number(inputCar.value);
      agregarProducto(nombreProducto,CodigoF, PrecioF, CantidadF );
      inputCar.value = "0"
    })
    sumCar.addEventListener('click', () => {
      inputCar.value = Number(inputCar.value) + 1
    })
    resCar.addEventListener('click', () => {
      if (inputCar.value == 0) {
        return
      }
      inputCar.value = Number(inputCar.value) - 1
    })
    var NombreLista = document.getElementById('Nombre');
    var NombreText = document.getElementById('nombreText');
    var btnNombre = document.getElementById('agregarNombre');
    let InputCompraB = document.getElementById('PrcCB');
    let InputVentaB = document.getElementById('PrcVB');
    let InputCompraD = document.getElementById('PrcCD');
    let InputVentaD = document.getElementById('PrcVD');
    InputCompraB.addEventListener('input', () => {
      InputVentaB.value = (Number(InputCompraB.value) * 1.5).toFixed(2);
      InputCompraD.value = (Number(InputCompraB.value) / 7.0).toFixed(2);
      InputVentaD.value = (Number(InputCompraB.value) / 7.0 * 1.5).toFixed(2);
    });

    InputCompraD.addEventListener('input', () => {
      InputVentaD.value = (Number(InputCompraD.value) * 1.5).toFixed(2);
      InputCompraB.value = (Number(InputCompraD.value) * 7.0).toFixed(2);
      InputVentaB.value = (Number(InputCompraD.value) * 7.0 * 1.5).toFixed(2);
    });

    InputVentaB.addEventListener('input', () => {
      InputVentaD.value = (Number(InputVentaB.value) / 7.0).toFixed(2);
    });

    InputVentaD.addEventListener('input', () => {
      InputVentaB.value = (Number(InputVentaD.value) * 7.0).toFixed(2);
    });

    opc = document.getElementById('opc');
    let visible = true;
    btnNombre.addEventListener('click', () => {
      if (visible) {
        NombreLista.setAttribute('style', "display:none");
        NombreText.setAttribute('style', "display:block;margin-bottom:10px");
        opc.value = 2;
      } else {
        NombreLista.setAttribute('style', "display:block");
        NombreText.setAttribute('style', "display:none");
        opc.value = 1;
      }
      visible = !visible;
    })
  </script>
</body>

</html>