<?php
// Incluimos los directorios a trabajar
require_once "funciones.php";

// Variables temporales
$id = "";
$idErr = "";
$errores=[];
$max_file_size = "512000";
 
// Procesamos el formulario al pulsar el botón aceptar de esta ficha
if(isset($_POST["aceptar"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    
     // Validamos el ID
     // Porque lo piede el enunciado tambien validamos la expresión regular
     $idVal = filtrado($_POST["id"]);
     if(empty($idVal) || !preg_match("/[A-Z]{2}[0-9]{2}[A-Z]-[A-Z]/", $idVal)){
         $idErr = "Por favor introduzca un ID válido.";
         $errores[] = "El ID no es valido";
     } else{
         $id= $idVal;
     }

     // Procesamos la extensión del a foto
     $extensionesValidas = array("jpg");
     $nombreArchivo = $_FILES['archivo']['name'];
     $arrayArchivo = pathinfo($nombreArchivo);
     $extension = $arrayArchivo['extension'];
    // Comprobamos la extensión del archivo
    if(!in_array($extension, $extensionesValidas)){
        $errores[] = "La extensión del archivo no es válida o no se ha subido ningún archivo";
    }
    // Comprobamos el tamaño del archivo
    if($filesize > $max_file_size){
        $errores[] = "La imagen debe de tener un tamaño inferior a 50 kb";
    }

    // Comprobamos que el id no existe
    if(existeNave($id)){
        $errores[] = "Ya existe la nave con ese ID";
    }
   

    // Chequeamos los errores antes de insertar en el fichero
    if(empty($errores)){
        $id = $idVal;
        $nave = filtrado($_POST["nave"]);
        // Utilizamos implode para pasar el array a string
        $municion = filtrado(implode(", ", $_POST["municion"]));
        $salto = filtrado($_POST["salto"]);
                
        // Procesamos la foto le añadimos una coletilla para que no hay ados fotos iguales
        
        $foto = nombreFoto($_FILES['archivo']['tmp_name']);
        // Copiamos la foto
        if ($_FILES['archivo']["error"] > 0){
            echo "Error: " . $_FILES['archivo']['error'] . "<br>";
        }else{
            move_uploaded_file($_FILES['archivo']['tmp_name'],"fotos/" . $foto);
        }

                
        // Lo guardamos en un fichero
        // Creamos la cadena 
        //$sal = $id. "|" .$nave. "|" .$municion. "|" .$salto. "|" .$foto;
        $nave = new Nave($id,$nave, $municion, $salto,$foto);

        // Grabamos los ficheros en el disco
        //salvarNave($sal);
        salvarNave($nave);

        alerta("Nave añadida con éxito");
        header("location: index.php");
        exit();
    }

}
?>
 
<!-- Cabecera de la página web -->
<?php require_once "cabecera.php"; ?>
<!-- Cuerpo de la página web -->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Crear Nave</h2>
                    </div>
                    <p>Por favor rellene este formulario para añadir una nueva nave a la flota imperial.</p>
                    <!-- Formulario-->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <!-- ID-->
                        <div class="form-group <?php echo (!empty($idErr)) ? 'error: ' : ''; ?>">
                            <label>ID</label>
                            <input type="text" required name="id" class="form-control" value="<?php echo $id; ?>" 
                                pattern="[A-Z]{2}[0-9]{2}[A-Z]-[A-Z]" 
                                title="Nave debe tener el formto LLNNL-L, donde L es una letra y N un número">
                            <span class="help-block"><?php echo $idErr;?></span>
                        </div>
                        <!-- Tipo de nave-->
                        <div class="form-group">
                        <label>Tipo de Nave</label>
                            <select name="nave">
                                <option value="combate" selected="selected">Combate</option>
                                <option value="transporte">Transporte</option>
                            </select>
                        </div>
                         <!-- Munición -->
                         <div class="form-group">
                            <label>Municion</label>
                            <input type="checkbox" name="municion[]" value="sin municion" checked="checked">Sin Munición</input>
                            <input type="checkbox" name="municion[]" value="torpedos">Torpedos</input>
                            <input type="checkbox" name="municion[]" value="laser">Laser</input>
                        </div>
                        <!-- Salto interestelar -->
                        <div class="form-group">
                            <label>Salto Interestelar</label>
                            <input type="radio" name="salto" value="Si" checked="checked">Sí</input>
                            <input type="radio" name="salto" value="No">No</input><br>
                        </div>
                        
                         <!-- Foto-->
                         <div class="form-group">
                        <label>Fotografía</label>
                            <input type="file"  required name="archivo" id="archivo" accept=".jpg"></input>
                        </div>
                        


                        </div>
                         <button type="submit"  name="aceptar" class="btn btn-primary"> <span class="glyphicon glyphicon-ok"></span>  Aceptar</button>
                        <a href="index.php" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Cancelar</a>
                    </form>
                </div>
                <?php
                    if(!empty($errores)){
                        alerta("Hay errores al procesar su formulario");
                        echo "<ul>";
                        foreach ($errores as $error) {
                            echo "<li> $error </li>";
                        }
                        echo "</ul>";
                    }
                ?>
            </div>        
        </div>
    </div>
    <br><br><br><br>
<!-- Pie de la página web -->
<?php require_once "pie.php"; ?>