<?php

$functionsPath = $_SERVER['DOCUMENT_ROOT']."/php-bancoxyz/connect/";
include_once($functionsPath . "conn.php");


$clientesId = [
    '56783219',
    '56783222',
    '56783225',
    '56783228',
    '56783231',
    '56783234',
    '56783237',
    '56783240',
    '56783243',
    '56783246',
    '56783249',
    '56783252',
    '56783255',
    '56783258',
    '56783261',
    '56783264',
    '56783267',
    '56783270',
    '56783273',
    '56783276',
    '56783279'
];


// Turn autocommit off
$conn -> autocommit(FALSE);


try {

    for($i = 0; $i < 2; $i++) {

        // $country = $cities[$key];
        for( $j = 0; $j < count($clientesId); $j++) {
            /* Start transaction */
            $conn->begin_transaction();

            $valorMvto = rand(1000,50000);
        
            $sql = "INSERT INTO Movimiento (clienteId, valorMvto) VALUES ('$clientesId[$j]', '$valorMvto')";
            $sql2 = "UPDATE Saldo SET valor = valor + $valorMvto WHERE clienteId =  '$clientesId[$j]'";

            echo($clientesId[$j] ." -> CONSIGNÓ: " .$valorMvto. "<br>");
            $conn->query($sql);
            $conn->query($sql2);

            $conn -> commit();

        }
    }
    
} catch(mysqli_sql_exception $exception) {
    $conn->rollback();
    echo "<h1>Error!!- ".$exception->getMessage()."</h1>";
    throw $exception;
}



$conn -> close();




?>