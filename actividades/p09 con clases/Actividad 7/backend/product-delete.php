<?php
    require_once 'API/Productos.php';

    $eliminar = new Productos('marketzone');
    $eliminar->delete($_POST['id'] );
    echo $eliminar->getResponse();
?>