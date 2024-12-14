<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Información del XML</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<?php
    // Conexion a la base de datos
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '137731',
        'plataforma'
    );
    if(!$conexion) {
        die('¡Base de datos NO conextada!');
    }




libxml_use_internal_errors(true);
$xml= new DOMDocument();
$documento = file_get_contents('serviciovod_ns_x1.xml');
$xml->loadXML($documento, LIBXML_NOBLANKS);
// o usa $xml->load si prefieres usar la ruta del archivo
$xsd = 'serviciovod_ns.xsd';
if (!$xml->schemaValidate($xsd))
// o usa $xml->schemaValidateSource si prefieres usar el xsd en format string
{
$errors = libxml_get_errors();
$noError = 1;
$lista = '';
foreach ($errors as $error)
{
$lista = $lista.'['.($noError++).']: '.$error->message.' ';
}
echo $lista;
}else {
    echo "<body>";
    $cuentas = $xml->getElementsByTagName('cuenta');
    foreach ($cuentas as $cuenta) {
        $correo = $cuenta->getAttribute('correo');
        echo '<h2>Información de la cuenta</h2>';
        echo '<p>Correo de la cuenta: ' . $correo . '</p>';
        $idCuenta = $conexion->insert_id; 
        
        //Insercion de datos en la base de datos

       $conexion->set_charset("utf8");
       $sql = "INSERT INTO cuenta VALUES (null, '$correo', 0)";
        $conexion->query($sql);
        
        // Obtener perfiles
        
        $perfiles = $cuenta->getElementsByTagName('perfil');
        echo '<h2>Perfiles</h2>';
        echo '<table>';
        echo '<tr><th>Usuario</th><th>Idioma</th></tr>';
        $idCuenta = $conexion->insert_id;
        foreach ($perfiles as $perfil) {
            $usuario = $perfil->getAttribute('usuario');
            $idioma = $perfil->getAttribute('idioma');
            echo '<tr>';
            echo '<td>' . $usuario . '</td>';
            echo '<td>' . $idioma . '</td>';
            echo '</tr>';

            //Insercion de datos en la base de datos
            
           $sql = "INSERT INTO perfiles VALUES (null, '$usuario','$idioma',0, '$idCuenta')";
           $conexion->query($sql);



        }
        echo '</table>';
    } 

      // <!-- Información de películas -->
      $peliculas = $xml->getElementsByTagName('peliculas');
      foreach ($peliculas as $pelicula) {
          echo '<h2>Películas</h2>';
          echo '<table>';
          echo '<tr><th>Título</th><th>Duración</th><th>Región</th><th>Género</th></tr>';
          $generos = $pelicula->getElementsByTagName('genero');
          foreach ($generos as $genero) {
              $nombreGenero = $genero->getAttribute('nombre');
              $titulos = $genero->getElementsByTagName('titulo');
              foreach ($titulos as $titulo) {
                  $duracion = $titulo->getAttribute('duracion');
                  $region = $pelicula->getAttribute('region');
                  echo '<tr>';
                  echo '<td>' . $titulo->nodeValue . '</td>';
                  echo '<td>' . $duracion .'minutos'. '</td>';
                  echo '<td>' . $region . '</td>';
                  echo '<td>' . $nombreGenero . '</td>';
                  echo '</tr>';

                  $sql = "INSERT INTO contenido VALUES (null, 'pelicula','$region','$nombreGenero','$titulo->nodeValue','$duracion',0, '$idCuenta')";
                  $conexion->query($sql);
              }


          }
          echo '</table>';
      }
  
  
 

    // <!-- Información de series -->

    $series = $xml->getElementsByTagName('series');
    foreach ($series as $serie) {
        echo '<h2>Series</h2>';
        echo '<table>';
        echo '<tr><th>Título</th><th>Duración</th><th>Región</th><th>Género</th></tr>';
        $generos = $serie->getElementsByTagName('genero');
        foreach ($generos as $genero) {
            $nombreGenero = $genero->getAttribute('nombre');
            $titulos = $genero->getElementsByTagName('titulo');
            foreach ($titulos as $titulo) {
                $duracion = $titulo->getAttribute('duracion');
                $region = $serie->getAttribute('region');
                echo '<tr>';
                echo '<td>' . $titulo->nodeValue . '</td>';
                echo '<td>' . $duracion .'minutos'. '</td>';
                echo '<td>' . $region . '</td>';
                echo '<td>' . $nombreGenero . '</td>';
                echo '</tr>';

                
                $sql = "INSERT INTO contenido VALUES (null, 'serie','$region','$nombreGenero','$titulo->nodeValue','$duracion',0, '$idCuenta')";
                $conexion->query($sql);
            }
        }
        echo '</table>';
    }



    echo "</body>";
}

?>
</html>