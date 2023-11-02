<?php
require_once 'API/Productos.php';

    $Crear = new Productos('marketzone');
    $Crear->add( json_decode( json_encode($_POST) ) );
    echo $Crear->getResponse();

?>