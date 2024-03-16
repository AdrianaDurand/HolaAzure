<?php

// PHP Data Objects(PDO) Sample Code:
// Solo lo del try es la conexion
try {
  // Conexión al servidor y la BD
    $conn = new PDO("sqlsrv:server = tcp:server1406858.database.windows.net,1433; Database = bd1406858", "adurand1406858", "Buenamarca2004");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Ejecutar una consulta
    $consulta = $conn->prepare("SELECT * FROM vendedores");
    $consulta->execute();

    echo "<pre>";
    var_dump($consulta->fetchAll(PDO::FETCH_ASSOC));
    echo "</pre>";
  }
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "adurand1406858", "pwd" => "{your_password_here}", "Database" => "bd1406858", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:server1406858.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

?>