<?php
$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
include_once($functionsPath . "conn.php");

$paisId = 'arg';

$sql = "SELECT p.nombre AS pais, city.nombre AS ciudad,
               cl.clienteId, cl.Nombre AS name, s.valor AS val
        FROM Saldo AS s
        JOIN Cliente AS cl ON s.clienteId = cl.clienteId
        JOIN Ciudad AS city ON cl.ciudadId = city.ciudadId
        JOIN Pais AS p ON city.paisId = p.paisId
        WHERE p.paisId = '$paisId'";
$saldoCliente = $conn->query($sql);

// echo $saldoCliente->num_rows. "<br><br>";
$i = 0;
while($row = $saldoCliente->fetch_assoc()){
    $id = number_format($row['clienteId']);
    $paisN = $row['pais'];
    $ciudad = $row['ciudad'];
    $name = $row['name'];
    $saldo = $row['val'];
    if ($i == 0){
        echo "<h1>Mostrando saldo</h1>";
        echo "<h2>Clientes de $paisN:</h2>";        
    }
    echo "Pais: $paisN - Ciudad: $ciudad => $name (CC $id) con saldo: $". number_format($saldo) . "<br><br>";
    $i++;
}


$conn -> close();




?>