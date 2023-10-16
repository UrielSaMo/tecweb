<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto, true);

        $nombre = $jsonOBJ["nombre"];
        $marca = $jsonOBJ["marca"];
        $modelo = $jsonOBJ["modelo"];
        $precio = $jsonOBJ["precio"];
        $detalles = $jsonOBJ["detalles"];
        $unidades = $jsonOBJ["unidades"];
        $imagen = $jsonOBJ["imagen"];

        $consultaObjs = $conexion->query("SELECT * FROM productos WHERE nombre='{$nombre}' AND eliminado=0");
        if ($consultaObjs->num_rows !=0){
            echo "El producto ya existe";
        }
        else { if ($result = $conexion->query("INSERT INTO productos VALUES(NULL, '{$nombre}', '{$marca}', '{$modelo}', '{$precio}', '{$detalles}', '{$unidades}', '{$imagen}',0) ")){
            echo "Este producto se ha agregado correctamente";
        }
        else{die("Query error: ".mysqli_error($conexion));
            echo "Este producto no fue agregado";
        }
    }$conexion->close();
        
    }
?>