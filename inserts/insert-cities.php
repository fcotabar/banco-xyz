<?php

$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
// echo $functionsPath."<br>";
include_once($functionsPath . "conn.php");


$cities = [
    'col' => ['mde' => 'Medellín','bga' => 'Bogotá', 'cal' => 'Cali'],
    'arg' => ['bue' => 'Buenos Aires','pam' => 'Pampa','pat' => 'Patagonia'],
    'per' => ['lim' => 'Lima','are' => 'Arequipa','chi' => 'Chiclayo'],
    'bra' => ['rio' => 'Río de Janeiro','sao' => 'Sao Pablo', 'bel' => 'Belo horizonte'],
    'ecu' => ['qui' => 'Quito', 'gua' => 'Guayaquil', 'cue' => 'Cuenca']
];

$countriesKeys = array_keys($cities);

// Turn autocommit off
$conn -> autocommit(FALSE);

/* Start transaction */
$conn->begin_transaction();

try {

    for($i = 0; $i < count($cities); $i++) {
        $countryKey = $countriesKeys[$i];
        $citiesKey = array_keys($cities[$countryKey]);

        // $country = $cities[$key];
        for( $j = 0; $j < count($cities[$countryKey]); $j++) {
            $cityKey = $citiesKey[$j];
            $city = $cities[$countryKey][$cityKey];
        
            $sql = "INSERT INTO Ciudad (ciudadId, paisId, nombre) VALUES ('$cityKey', '$countryKey', '$city')";

            // if($i > 3) $sql = "INSERT INTO Pais2 (paisId, nombre) VALUES ('$key', '$country')";

            echo($cityKey ." -> " .$countryKey.  " -> " .$city. "<br>");
            $conn->query($sql);
        }
    }
    $conn -> commit();
} catch(mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "<h1>Error!!- ".$exception->getMessage()."</h1>";
    throw $exception;
}



$conn -> close();




?>