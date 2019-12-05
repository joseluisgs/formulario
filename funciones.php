<?php

   // -- CConfiguración de elementos del programa -->
   require_once "config.php";
   require_once "nave.php";

// alerta de texto
function alerta($texto) {
    echo '<script type="text/javascript">alert("' . $texto . '")</script>';
}

// filtrado de datos de formulario
function filtrado($datos) {
    $datos = trim($datos); // Elimina espacios antes y después de los datos
    $datos = stripslashes($datos); // Elimina backslashes \
    $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
    return $datos;
}

// salva los datos en el fichero
/*
function salvarNave($cadena){
    $fp = fopen(FILE_PATH."naves.txt", "a");
    fputs($fp, $cadena);
    fputs($fp, PHP_EOL);
    fclose($fp);
}
*/
function salvarNave($nave){
    $cadena = $nave->getID(). "|" .$nave->getTipo(). "|" .$nave->getMunicion(). "|" .$nave->getSalto(). "|" .$nave->getFoto();
    $fp = fopen(FILE_PATH."naves.txt", "a");
    fputs($fp, $cadena);
    fputs($fp, PHP_EOL);
    fclose($fp);
}

function leerNaves(){
    // Creamos una lista vacía
   $lista=[];
   // Antes de nada compruebo que existe para leerlo.
   if(file_exists(FILE_PATH."naves.txt")){
        $fp = fopen(FILE_PATH."naves.txt", "r");
        while(!feof($fp)) {
            $linea = fgets($fp);
            $datos = explode("|", $linea);
            if (count($datos)==5) {
                $nave = new Nave($datos[0],$datos[1], $datos[2], $datos[3],$datos[4]);
                /*
                $nave=[
                    "id"=>$datos[0],
                    "nave"=>$datos[1],
                    "municion"=>$datos[2],
                    "salto"=>$datos[3],
                    "foto"=>$datos[4],
                ];
                */
                // Insertamos al final
                $lista[]=$nave; // array_push($lista,$nave);
            }
        }
        // Cerramos el fichero
        fclose($fp);
   }
    return $lista;

}

// le añadimos una coletilla para que no haya dos fotos iguales
function nombreFoto($cadena){
    $datos=md5(hash_file('md5', $cadena) . time()) . ".jpg";
    return $datos;
}

// Existe en lista
function existeNave($id){
    $salida = false;
    $lista = leerNaves();
    foreach ($lista as $nave) {
        if($nave->getID()===$id){ // if($nave["id"]===$id){
            $salida = true;
        }
    }
    return $salida;
}


