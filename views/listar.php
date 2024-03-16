<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendedores</title>

</head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col">
                <div class="alert alert-warning text-center" role="alert">
                <strong class="h4"><i class="bi bi-person-circle"></i>  VENDEDORES</strong>
                </div>
            </div>
            <div class="col-auto">
                <button id="guardarvendedor" type="button" class="btn btn-info text-white btn-lg"><i class="bi bi-person-fill-add"></i> Agregar</button>
            </div>
        </div>
    </div>


    <div class="container">
      <table class="table table-sm table-striped" id="tabla-vendedores">
      <colgroup>
            <col width="5%"> 
            <col width="25%"> 
            <col width="20%"> 
            <col width="10%"> 
            <col width="20%"> 
            <col width="20%"> 
          </colgroup>
        <thead>
              <tr>
                <th>#</th>
                <th>Apellidos</th>
                <th>Nombres</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Correo</th>
              </tr>
            </thead>
      <tbody>
          <!-- DATOS ASINCRONOS -->
      </tbody>
    </table>
    </div>

    <div class="modal" id="modal-vendedor" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="modalTitleId"> <i class="bi bi-person-fill-add"></i> Agregar Vendedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="formulario-vendedor">
          <!-- Apellidos -->
          <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" required>
          </div>
          <!-- Nombres -->
          <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" required>
          </div>
          <!-- DNI -->
          <div class="row mb-3">
            <div class="col">
              <label for="dni" class="form-label">DNI</label>
              <input type="number" class="form-control" id="dni" required minlength="8" maxlength="8">
            </div>
            <!-- Teléfono -->
            <div class="col">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="number" class="form-control" id="telefono" minlength="9" maxlength="9">
            </div>
          </div>
          <!-- Correo -->
          <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" >
          </div>
        </form>
      </div>
      <!-- Botones -->
      <div class="modal-footer">
        <button type="button" id="btncancelar" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="btnguardar" class="btn btn-success">Guardar</button>
      </div>
    </div>
  </div>
</div>


    

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>

  document.addEventListener("DOMContentLoaded", () => {
    const btnAbrirModal = document.querySelector("#guardarvendedor");
    const modalRegistro = new bootstrap.Modal(document.getElementById('modal-vendedor'));
    function $(id){return document.querySelector(id)};

    btnAbrirModal.addEventListener("click", () => {
      modalRegistro.show();
    });

    function listar() {
      const parametros = new FormData();
      parametros.append("operacion", "listar");

      fetch(`../controllers/vendedor.controllers.php`, {
        method: "POST",
        body: parametros
      })
      .then(respuesta => respuesta.json())
      .then(datos => {
        const tbody = document.querySelector("#tabla-vendedores tbody");
        tbody.innerHTML = '';

        let numFila = 1;
        datos.forEach(element => {
          const nuevaFila = document.createElement('tr');
          nuevaFila.innerHTML = `
            <td>${numFila}</td>
            <td>${element.apellidos}</td>
            <td>${element.nombres}</td>
            <td>${element.dni}</td>
            <td>${element.telefono}</td>
            <td>${element.correo}</td>
          `;
          tbody.appendChild(nuevaFila);
          numFila++;
        });
      })
      .catch(e => {
        console.error(e);
      });
    }

      listar();
      
      document.querySelector("#btnguardar").addEventListener("click", function() {
        registrar();
        document.getElementById("formulario-vendedor").reset();
      });

      function registrar(){
        const parametros = new FormData();
        parametros.append("operacion", "registrar");
        parametros.append("apellidos", $("#apellidos").value);
        parametros.append("nombres", $("#nombres").value);
        parametros.append("dni", $("#dni").value);
        parametros.append("telefono", $("#telefono").value);
        parametros.append("correo", $("#correo").value);

        fetch(`../controllers/vendedor.controllers.php`, {
          method:"POST",
          body:parametros
        })
        .then(respuesta => respuesta.text())
        .then(datos =>{
          modalRegistro.hide();
          listar();
        })
        .catch(e =>{
          console.error(e)
        })
      }


 });
</script>
</body>
</html>