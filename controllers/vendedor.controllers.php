<?php
require_once '../models/Vendedor.php';

if (isset($_POST['operacion'])){
  
  $vendedor = new Vendedor();

  switch ($_POST['operacion']){

    case 'listar':
      echo json_encode($vendedor->listar());
    break;


    case 'registrar':
      $datosEnviar = [
        'apellidos' => $_POST['apellidos'],
        'nombres'   => $_POST['nombres'],
        'dni'       => $_POST['dni'],
        'telefono'  => $_POST['telefono'],
        'correo'    => $_POST['correo']
      ];
      
      echo json_encode($vendedor->registrar($datosEnviar));
    break;

  }
}

?>