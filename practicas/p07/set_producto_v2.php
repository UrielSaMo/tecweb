<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $detalles = $_POST["detalles"];
    $unidades = $_POST["unidades"];
    $imagen = $_POST["imagen"];

    
        @$link = new mysqli('localhost', 'root', '137731', 'marketzone');	

        // Comprobar la conexión
        if ($link->connect_errno) {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
        }

        // Crear una tabla que no devuelve un conjunto de resultados
        $sql = "UPDATE productos SET 
        nombre = '{$nombre}',
        marca = '{$marca}',
        modelo = '{$modelo}',
        precio = {$precio},
        detalles = '{$detalles}',
        unidades = {$unidades},
        imagen = '{$imagen}'
        WHERE id = {$id}";

        if ($link->query($sql)) {
            $id_insertado = $link->insert_id;
            echo 'Producto insertado con ID: ' . $id_insertado . '<br>';
            echo 'Nombre: ' . $nombre . '<br>';
            echo 'Marca: ' . $marca . '<br>';
            echo 'Modelo: ' . $modelo . '<br>';
            echo 'Precio: ' . $precio . '<br>';
            echo 'Detalles: ' . $detalles . '<br>';
            echo 'Unidades: ' . $unidades . '<br>';
            echo 'Imagen: ' . $imagen . '<br>';
        } else {
            echo 'El Producto no pudo ser insertar =(';
        }

        $link->close();   
}
?>
