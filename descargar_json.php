<?php

require_once "funciones.php";


$nombre = 'lista_de_naves.json'; // Nombre del archivo final

//header("Content-Type: application/octet-stream");


$lista = leerNaves();

//print_r(array_values($lista));

header('Content-type: application/json');
//header("Content-Disposition: attachment; filename=" . $nombre . ""); //archivo de salida
echo json_encode($lista);
exit;


?>
