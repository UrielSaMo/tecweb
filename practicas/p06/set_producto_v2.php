<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $detalles = $_POST["detalles"];
    $unidades = $_POST["unidades"];
    $imagen = $_POST["imagen"];

    // Validaciones
    $errores = array();

    // Validar que nombre, marca, modelo, detalles e imagen no estén vacíos o contengan solo espacios
    if (empty($nombre) || empty($marca) || empty($modelo) || empty($detalles) || empty($imagen)) {
        $errores[] = "Los campos Nombre, Marca, Modelo, Detalles e Imagen son obligatorios.";
    }

    // Validar que el precio sea un número positivo con dos decimales
    if (!is_numeric($precio) || $precio <= 0 || !preg_match("/^\d+(\.\d{2})?$/", $precio)) {
        $errores[] = "El campo Precio debe ser un número positivo con dos decimales.";
    }

    // Validar que las unidades sean un número entero positivo
    if (!is_numeric($unidades) || $unidades <= 0 || floor($unidades) != $unidades) {
        $errores[] = "El campo Unidades debe ser un número entero positivo.";
    }

    // Validar que precio y unidades sean mayores a uno
    if ($precio <= 0 || $unidades <= 0) {
        $errores[] = "El Precio y las Unidades deben ser mayores a uno.";
    }

    // Si no hay errores, insertar en la base de datos
    if (empty($errores)) {
        @$link = new mysqli('localhost', 'root', '137731', 'marketzone');	

        // Comprobar la conexión
        if ($link->connect_errno) {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
        }

        // Crear una tabla que no devuelve un conjunto de resultados
        $sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

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
    } else {
        // Si hay errores, mostrar los mensajes de error
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
