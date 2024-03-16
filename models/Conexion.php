<?php

class Conexion{

  public function getConexion(){

    try {
          $conn = new PDO("sqlsrv:server = tcp:server1406858.database.windows.net,1433; Database = bd1406858", "adurand1406858", "Buenamarca2004");
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          //Ejecutar una consulta
          return $conn;
      }
    catch (PDOException $e) {
        print("Error connecting to SQL Server.");
        die(print_r($e));
    }
  }

}

?>