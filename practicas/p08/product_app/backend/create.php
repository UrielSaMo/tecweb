<?php
include_once __DIR__.'/database.php';
// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');
if (!empty($producto)) {
    $res = array("mensaje" => "");

    // SE TRANSFORMA EL STRING DEL JSON A UN OBJETO
    $jsonOBJ = json_decode($producto, true);

    $nombre = $jsonOBJ["nombre"];
    $marca = $jsonOBJ["marca"];
    $modelo = $jsonOBJ["modelo"];
    $precio = $jsonOBJ["precio"];
    $detalles = $jsonOBJ["detalles"];
    $unidades = $jsonOBJ["unidades"];
    $imagen = $jsonOBJ["imagen"];

    // Verifica si el producto ya existe en la base de datos
    $busqueda = $conexion->query("SELECT COUNT(*) as count FROM productos WHERE nombre='{$nombre}' AND eliminado=0");
    $row = $busqueda->fetch_assoc();
    $count = $row["count"];

    if ($count > 0) {
        $res["mensaje"] = "El producto ya existe";
    } else {
        if ($result = $conexion->query("INSERT INTO productos VALUES(NULL, '{$nombre}', '{$marca}', '{$modelo}', '{$precio}', '{$detalles}', '{$unidades}', '{$imagen}', 0) ")) {
            $res["mensaje"] = "Este producto se ha agregado correctamente";
        } else {
            $res["mensaje"] = "Este producto no fue agregado: " . mysqli_error($conexion);
        }
    }

    $conexion->close();
} else {
    $res["mensaje"] = "No se recibieron datos válidos";
}

header("Content-Type: application/json");
echo json_encode($res, JSON_PRETTY_PRINT);
?>
