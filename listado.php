<?php
    // Incluimos los ficheros que ncesitamos
    require_once "funciones.php";
    require_once "nave.php";
?>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Listado de Naves</h2>
                </div>

                    <!-- Aquí va el nuevo botón para dar de alta, podría ir al final -->   
                    <a href="descargar_json.php" class="btn pull-right" target="_blank"><span class="glyphicon glyphicon-download"></span>  JSON</a>
                    <a href="crear.php" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plane"></span>  Nueva Nave</a>
                    
            </div>
            <!-- Linea para dividir -->
            <div class="page-header clearfix">        
            </div>
            <?php


           $lista = leerNaves();
           // Ordenamos los datos en orden ascendente
           asort($lista);

            

            // Si hay filas (no nulo), pues mostramos la tabla
            if (!is_null($lista) && count($lista) > 0) {
                echo "<table class='table table-bordered table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Tipo Nave</th>";
                echo "<th>Munición</th>";
                echo "<th>Salto Interestelar</th>";
                echo "<th>Foto</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";


                // Recorremos los registros encontrado
                foreach ($lista as $nave) {
                    // Pintamos cada fila
                    /*
                    echo "<tr>";
                    echo "<td>" . $nave["id"]. "</td>";
                    echo "<td>" . $nave["nave"]. "</td>";
                    echo "<td>" . $nave["municion"]. "</td>";
                    echo "<td>" . $nave["salto"]. "</td>";
                    echo "<td><img src='fotos/".$nave["foto"]."' width='120px' height='120px'></td>";
                    */
                    echo "<tr>";
                    echo "<td>" . $nave->getID(). "</td>";
                    echo "<td>" . $nave->getTipo(). "</td>";
                    echo "<td>" . $nave->getMunicion(). "</td>";
                    echo "<td>" . $nave->getSalto(). "</td>";
                    echo "<td><img src='fotos/".$nave->getFoto()."' width='120px' height='120px'></td>";
    
     
                    
                    //echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                // Si no hay nada seleccionado
                echo "<p class='lead'><em>No se ha encontrado datos de naves del imperio.</em></p>";
            }
            ?>

        </div>
    </div>        

<br><br><br><br>