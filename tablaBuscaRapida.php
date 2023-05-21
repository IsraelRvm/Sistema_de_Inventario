<div class="table-responsive">

  <table class="table table-hover table-bordered border-primary">
    <thead>
      <tr class="table-dark">
        <th scope="col">Codigo</th>
        <th scope="col">Marca</th>
        <th scope="col">Coche</th>
        <th scope="col">Detalles</th>
        <th scope="col">Precio</th>
        <th scope="col">Imagen</th>
      </tr>
    </thead>
    <tbody id="TablaAMostrar">
      <script>
        let titulo = document.getElementById('ActOrAgr');
        let labelBtn = document.getElementById('liveToastBtn');
        let opc = document.getElementById('opc');
        const actualizarInput = document.getElementById('flexRadioDefault2');
        const agregarInput = document.getElementById('flexRadioDefault1');
        agregarInput.addEventListener('change', () => {
          opc.value = 1;
          let NombreE = document.getElementById('Nombre');
          let CodigoE = document.getElementById('Codigo');
          let MarcaE = document.getElementById('Marca');
          let CocheE = document.getElementById('Coche');
          let DetallesE = document.getElementById('Detalles');
          let PrecioVE = document.getElementById('PrcVB');
          let PrecioVC = document.getElementById('PrcCB');
          let PrecioVED = document.getElementById('PrcVD');
          let PrecioVCD = document.getElementById('PrcCD');
          let Proveedor = document.getElementById('Proveedor');
          let id = document.getElementById('id');
          NombreE.value = " ";
          CodigoE.value = " ";
          Marca.value = " ";
          Coche.value = " ";
          DetallesE.value = " ";
          PrecioVE.value = " ";
          PrecioVC.value = " ";
          PrecioVED.value = " ";
          PrecioVCD.value = " ";
          labelBtn.value = "AGREGAR";
          titulo.textContent = "Agregar producto"
        });

        actualizarInput.addEventListener('change', () => {
          opc.value = 2;
          labelBtn.value = "ACTUALIZAR";
          titulo.textContent = "Actualizar producto"
        });

        function actualizarTabla(CodigoB = "") {
          const tabla = document.getElementById("TablaAMostrar");
          tabla.innerHTML = ""; // Limpiamos la tabla antes de actualizarla
          const productosFiltrados = Productos.filter(function(producto) {
            return (producto.Codigo.toUpperCase().includes(CodigoB.toUpperCase()));
          });
          productosFiltrados.sort(function(a, b) {
            const nombreA = a.Codigo.toUpperCase();
            const nombreB = b.Codigo.toUpperCase();

            if (nombreA < nombreB) {
              return -1;
            }
            if (nombreA > nombreB) {
              return 1;
            }
            return 0;
          });
          let CantidadDatos = 0;
          productosFiltrados.forEach(function(producto) {
            if (CantidadDatos == 50) {
              return "";
            }
            CantidadDatos++;
            const row = document.createElement("tr");
            row.classList.add("table-primary");
            const codigo = document.createElement("th");
            codigo.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            codigo.setAttribute("scope", "row");
            const codigoText = document.createTextNode(producto.Codigo);
            codigo.appendChild(codigoText);
            const marca = document.createElement("td");
            marca.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            marca.textContent = producto.Marca;
            const coche = document.createElement("td");
            coche.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            coche.textContent = producto.Coche;
            const detalles = document.createElement("td");
            detalles.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            detalles.textContent = producto.Detalles;
            const precio = document.createElement("th");
            precio.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            precio.textContent = producto.PrecioVentaD+".-Dl";
            const imagen = document.createElement("td");
            imagen.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            const img = document.createElement("img");
            img.setAttribute("src", "imgs/" + producto.img);
            img.setAttribute("alt", "Sin imagen");
            img.setAttribute("style", "width:70px;height:70px;cursor:pointer");
            const btn2 = document.createElement("button");
            const formEliminate = document.createElement('form');
            const inputID = document.createElement('input')
            inputID.setAttribute('type', 'hidden')
            inputID.setAttribute('name', 'ID')
            const inputOPC = document.createElement('input')
            inputOPC.setAttribute('type', 'hidden')
            inputOPC.setAttribute('value', '4')
            inputOPC.setAttribute('name', 'opc')
            inputID.setAttribute('id', 'ID');
            inputOPC.setAttribute('id', 'opc');
            formEliminate.setAttribute('action', 'index.php')
            formEliminate.setAttribute('method', 'post')
            formEliminate.setAttribute('style', 'display:inline-block')
            btn2.classList.add('btn');
            btn2.setAttribute('style', 'margin-left:30px')
            formEliminate.appendChild(inputOPC)
            formEliminate.appendChild(inputID)
            formEliminate.appendChild(btn2)
            img.setAttribute('id', 'ver');
            img.setAttribute('data-bs-toggle', 'modal');
            img.setAttribute('data-bs-target', '#exampleModal');
            img.addEventListener('click', () => {
              PrecioF=producto.PrecioVentaB
              nombreProducto=producto.Nombre
              CodigoF=producto.Codigo
              let titulo = document.getElementById('exampleModalLabel');
              let imagenModal = document.getElementById('imgModal')
              imagenModal.setAttribute('src', "imgs/" + producto.img)
              titulo.textContent = producto.Codigo
            })
            btn2.classList.add('btn-danger');
            btn2.setAttribute('type', 'submit')
            const icono2 = document.createElement("i");
            icono2.setAttribute("class", "bi bi-trash");
            btn2.addEventListener('click', () => {
              inputID.setAttribute('value', producto.ID)
            })
            btn2.appendChild(icono2);
            row.addEventListener('dblclick', () => {
              let BtnEdit = document.getElementById('Edit');
              if (BtnEdit.getAttribute('aria-expanded') === 'false') {
                BtnEdit.click();
              }
              actualizarInput.click();
              let NombreE = document.getElementById('Nombre');
              let CodigoE = document.getElementById('Codigo');
              let MarcaE = document.getElementById('Marca');
              let CocheE = document.getElementById('Coche');
              let DetallesE = document.getElementById('Detalles');
              let PrecioVEB = document.getElementById('PrcVB');
              let PrecioVCB = document.getElementById('PrcCB');
              let PrecioVED = document.getElementById('PrcVD');
              let PrecioVCD = document.getElementById('PrcCD');
              let Proveedor = document.getElementById('Proveedor');
              let id = document.getElementById('id');
              id.value = producto.ID;
              let opc = document.getElementById('opc');
              opc.value = 2;
              NombreE.value = producto.Nombre;
              CodigoE.value = producto.Codigo;
              Marca.value = producto.Marca;
              Coche.value = producto.Coche;
              DetallesE.value = producto.Detalles;
              PrecioVEB.value = producto.PrecioVentaB;
              PrecioVCB.value = producto.PrecioCompraB;
              PrecioVED.value = producto.PrecioVentaD;
              PrecioVCD.value = producto.PrecioCompraD;
              Proveedor.value = producto.Proveedor;
            })
            imagen.appendChild(img);
            imagen.appendChild(formEliminate);
            row.appendChild(codigo);
            row.appendChild(marca);
            row.appendChild(coche);
            row.appendChild(detalles);
            row.appendChild(precio);
            row.appendChild(imagen);
            tabla.appendChild(row);
          });


        }


        function BusquedaEspecifica(CodigoB = "", CocheB = "", DetallesB = "") {
          var selectElement = document.getElementById("Tecnica");
          var selectedOption = selectElement.options[selectElement.selectedIndex].value;

          console.log(selectedOption)
          console.log(CodigoB)
          console.log(CocheB)
          console.log(DetallesB)
          const html = `<div id= "Buscador" class="d-flex justify-content-between" style="max-width:auto;margin:40px 20px" >
             <div> <input id="InputCodigo" type="text" class="form-control" name="Codigo" placeholder="Codigo del producto" oninput="BusquedaEspecifica(this.value)">
            </div>
             <div> <input id="InputCoche" type="text" class="form-control" name="Nombre" placeholder="Coche" oninput="BusquedaEspecifica(undefined,this.value)">
       
       
              </div>
              <div> <input id="InputDetalles" type="text" class="form-control" name="Busqueda" placeholder="Detalles" oninput="BusquedaEspecifica(undefined,undefined,this.value)">
       
       
            </div>
              </div>
                  `;
          if (selectedOption == "Selecciona el producto") {
            selectedOption = ""
          }
          const vista = document.getElementById('TablaWrapper');
          // Verificar si el elemento ya existe antes de agregar el HTML
          if (!document.getElementById('Buscador')) {
            vista.insertAdjacentHTML('beforebegin', html);
          }
          var Cod = document.getElementById('InputCodigo');
          var CocheX = document.getElementById('InputCoche');
          var DetallesX = document.getElementById('InputDetalles');
          // Comprobar si los valores de los input están definidos
          if (Cod.value.trim() !== '') {
            CodigoB = Cod.value;
          }
          if (CocheX.value !== '') {
            CocheB = CocheX.value;
          }
          if (DetallesX.value !== '') {
            DetallesB = DetallesX.value;
          }
          const tabla = document.getElementById("TablaAMostrar");
          tabla.innerHTML = ""; // Limpiamos la tabla antes de actualizarla

          const productosFiltrados = Productos.filter(function(producto) {
            return ( producto.Nombre.toUpperCase() === selectedOption.toUpperCase() && producto.Codigo.toUpperCase().includes(CodigoB.toUpperCase()) && producto.Detalles.toUpperCase().includes(DetallesB.toUpperCase()) && producto.Coche.toUpperCase().includes(CocheB.toUpperCase()));
          });
          productosFiltrados.sort(function(a, b) {
            const nombreA = a.Codigo.toUpperCase();
            const nombreB = b.Codigo.toUpperCase();

            if (nombreA < nombreB) {
              return -1;
            }
            if (nombreA > nombreB) {
              return 1;
            }
            return 0;
          });
          let CantidadDatos = 0;
          productosFiltrados.forEach(function(producto) {
            if (CantidadDatos == 50) {
              return "";
            }
            CantidadDatos++;
            const row = document.createElement("tr");
            row.classList.add("table-primary");
            const codigo = document.createElement("th");
            codigo.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            codigo.setAttribute("scope", "row");
            const codigoText = document.createTextNode(producto.Codigo);
            codigo.appendChild(codigoText);
            const marca = document.createElement("td");
            marca.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            marca.textContent = producto.Marca;
            const coche = document.createElement("td");
            coche.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            coche.textContent = producto.Coche;
            const detalles = document.createElement("td");
            detalles.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            detalles.textContent = producto.Detalles;
            const precio = document.createElement("th");
            precio.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            precio.textContent = producto.PrecioVentaD+".-Dl";
            const imagen = document.createElement("td");
            imagen.setAttribute("style", "max-width:10vw; word-wrap: break-word;");
            const img = document.createElement("img");
            img.setAttribute("src", "imgs/" + producto.img);
            img.setAttribute("alt", "Sin imagen");
            img.setAttribute("style", "width:70px;height:70px;cursor:pointer");
            const btn2 = document.createElement("button");
            const formEliminate = document.createElement('form');
            const inputID = document.createElement('input')
            inputID.setAttribute('type', 'hidden')
            inputID.setAttribute('name', 'ID')
            const inputOPC = document.createElement('input')
            inputOPC.setAttribute('type', 'hidden')
            inputOPC.setAttribute('value', '4')
            inputOPC.setAttribute('name', 'opc')
            inputID.setAttribute('id', 'ID');
            inputOPC.setAttribute('id', 'opc');
            formEliminate.setAttribute('action', 'index.php')
            formEliminate.setAttribute('method', 'post')
            formEliminate.setAttribute('style', 'display:inline-block')
            btn2.classList.add('btn');
            btn2.setAttribute('style', 'margin-left:30px')
            formEliminate.appendChild(inputOPC)
            formEliminate.appendChild(inputID)
            formEliminate.appendChild(btn2)
            img.setAttribute('id', 'ver');
            img.setAttribute('data-bs-toggle', 'modal');
            img.setAttribute('data-bs-target', '#exampleModal');
            img.addEventListener('click', () => {
              PrecioF=producto.PrecioVentaB
              nombreProducto=producto.Nombre
              CodigoF=producto.Codigo
              let titulo = document.getElementById('exampleModalLabel');
              let imagenModal = document.getElementById('imgModal')
              imagenModal.setAttribute('src', "imgs/" + producto.img)
              titulo.textContent = producto.Codigo
            })
            btn2.classList.add('btn-danger');
            btn2.setAttribute('type', 'submit')
            const icono2 = document.createElement("i");
            icono2.setAttribute("class", "bi bi-trash");
            btn2.addEventListener('click', () => {
              inputID.setAttribute('value', producto.ID)
            })
            btn2.appendChild(icono2);
            row.addEventListener('dblclick', () => {
              let BtnEdit = document.getElementById('Edit');
              if (BtnEdit.getAttribute('aria-expanded') === 'false') {
                BtnEdit.click();
              }
              actualizarInput.click();
              let NombreE = document.getElementById('Nombre');
              let CodigoE = document.getElementById('Codigo');
              let MarcaE = document.getElementById('Marca');
              let CocheE = document.getElementById('Coche');
              let DetallesE = document.getElementById('Detalles');
              let PrecioVEB = document.getElementById('PrcVB');
              let PrecioVCB = document.getElementById('PrcCB');
              let PrecioVED = document.getElementById('PrcVD');
              let PrecioVCD = document.getElementById('PrcCD');
              let Proveedor = document.getElementById('Proveedor');
              let id = document.getElementById('id');
              id.value = producto.ID;
              let opc = document.getElementById('opc');
              opc.value = 2;
              NombreE.value = producto.Nombre.toUpperCase();
              CodigoE.value = producto.Codigo;
              Marca.value = producto.Marca;
              Coche.value = producto.Coche;
              DetallesE.value = producto.Detalles;
              PrecioVEB.value = producto.PrecioVentaB;
              PrecioVCB.value = producto.PrecioCompraB;
              PrecioVED.value = producto.PrecioVentaD;
              PrecioVCD.value = producto.PrecioCompraD;
              Proveedor.value = producto.Proveedor;
            })
            imagen.appendChild(img);
            imagen.appendChild(formEliminate);
            row.appendChild(codigo);
            row.appendChild(marca);
            row.appendChild(coche);
            row.appendChild(detalles);
            row.appendChild(precio);
            row.appendChild(imagen);
            tabla.appendChild(row);
          });


        }
      </script>
    </tbody>

  </table>
</div>

</tbody>
</table>
</div>