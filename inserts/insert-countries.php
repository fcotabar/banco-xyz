<?php

$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
// echo $functionsPath."<br>";
include_once($functionsPath . "conn.php");


$countries = [
    'col' => 'Colombia',
    'arg' => 'Argentina',
    'per' => 'Perú',
    'bra' => 'Brazil',
    'ecu' => 'Ecuador'

];

$keys = array_keys($countries);


// Turn autocommit off
$conn -> autocommit(FALSE);

/* Start transaction */
$conn->begin_transaction();

try {

    for($i = 0; $i < count($countries); $i++) {
        $key = $keys[$i];
        $country = $countries[$key];
        
        $sql = "INSERT INTO Pais (paisId, nombre) VALUES ('$key', '$country')";

        // if($i > 3) $sql = "INSERT INTO Pais2 (paisId, nombre) VALUES ('$key', '$country')";

        echo($key ." -> " .$country. "<br>");
        $conn->query($sql);
    }
    $conn -> commit();
} catch(mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "<h1>Error!!- ".$exception->getMessage()."</h1>";
    throw $exception;
}



$conn -> close();




?>