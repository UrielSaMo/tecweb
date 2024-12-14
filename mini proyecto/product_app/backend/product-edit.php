<?php
    use BACKEND\API\Productos;
    require_once __DIR__.'/API/Productos.php';

    $productos = new Productos('plataforma');
    $productos->edit( json_decode( json_encode($_POST) ) );
    echo $productos->getResponse();
?>