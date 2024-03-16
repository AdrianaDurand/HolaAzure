<?php

require_once 'Conexion.php';

class Vendedor extends Conexion{
  private $conexion;

  public function __CONSTRUCT(){
    $this->conexion = parent::getConexion();
  }

  public function listar(){
    try{
      $consulta = $this->conexion->prepare("EXECUTE vendedores_todos");
      $consulta->execute();
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMessage());
    }
  }

  public function registrar($datos = []){
    try {
      $consulta = $this->conexion->prepare("EXECUTE vendedor_registrar ?,?,?,?,?");
      $consulta->execute(array(
        $datos['apellidos'],
        $datos['nombres'],
        $datos['dni'],
        $datos['telefono'],
        $datos['correo']
      ));

    } catch (Exception $e) {
      die($e->getMessage());
    }
  }
}

?>