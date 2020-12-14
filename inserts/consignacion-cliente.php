<?php

$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
include_once($functionsPath . "conn.php");


$clienteId = '56783240';
$valorConsignacion = 50000;

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

echo "Consigna: $" . number_format($valorConsignacion). "<br><br>";

// Turn autocommit off
$conn -> autocommit(FALSE);

try {
    /* Start transaction */
    $conn->begin_transaction();


    $sql = "INSERT INTO Movimiento (clienteId, valorMvto)
            VALUES ('$clienteId', '$valorConsignacion')";
    $sql2 = "UPDATE Saldo SET valor = valor + $valorConsignacion WHERE clienteId =  '$clienteId'";

    $conn->query($sql);
    $conn->query($sql2);

    $conn -> commit();

} catch(mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "<h1>Error!!- ".$exception->getMessage()."</h1>";
    throw $exception;
}

// Turn autocommit on
$conn -> autocommit(TRUE);

$sql = "SELECT  s.valor AS val
        FROM Saldo AS s
        WHERE s.clienteId = '$clienteId'";
$saldoCliente = $conn->query($sql);

// echo $saldoCliente->num_rows. "<br><br>";

while($row = $saldoCliente->fetch_assoc()){
    // $id = number_format($clienteId);
    // $name = $row['name'];
    $saldo = $row['val'];
    echo $name." (CC $id) NUEVO SALDO: $". number_format($saldo) . "<br><br>";
}



$conn -> close();




?>