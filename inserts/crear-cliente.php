<?php

$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
include_once($functionsPath . "conn.php");


$clienteId = '58783219';
$nombreCliente = "Carlos Pérez";
$ciudadCliente = "mde";
$saldoInicial = 500000;

// Turn autocommit off
$conn -> autocommit(FALSE);

try {
    /* Start transaction */
    $conn->begin_transaction();


    $sql1 = "INSERT INTO Cliente (clienteId, Nombre, ciudadId)
            VALUES ('$clienteId', '$nombreCliente', '$ciudadCliente')";
    $conn->query($sql1);

    $sql2 = "INSERT INTO Movimiento (clienteId, tipoMvto, valorMvto)
            VALUES ('$clienteId', 'S.INICIAL', '$saldoInicial')";
    $conn->query($sql2);

    $sql3 = "INSERT INTO Saldo (clienteId, valor)
            VALUES ('$clienteId', '$saldoInicial')";
    $conn->query($sql3);



    $conn -> commit();

} catch(mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "<h1>Error!!- ".$exception->getMessage()."</h1>";
    throw $exception;
}


echo "<h1>Ingresando cliente nuevo</h1>";
echo "<h2>Se ingresó correctamente:</h2>";



// Turn autocommit on
$conn -> autocommit(TRUE);

$sql = "SELECT  cl.Nombre AS name, valor AS val
        FROM Saldo AS s
        JOIN Cliente AS cl ON s.clienteId = cl.clienteId
        WHERE s.clienteId = '$clienteId'";
$saldoCliente = $conn->query($sql);

// echo $saldoCliente->num_rows. "<br><br>";

while($row = $saldoCliente->fetch_assoc()){
    $id = number_format($clienteId);
    $name = $row['name'];
    $saldo = $row['val'];
    echo $name." (CC $id) con saldo: $". number_format($saldo) . "<br><br>";
}


$conn -> close();




?>