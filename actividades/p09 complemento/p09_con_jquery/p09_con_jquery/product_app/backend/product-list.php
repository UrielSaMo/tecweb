<?php

    require_once 'API/Productos.php';

    $productos = new Productos('marketzone');
    $productos->list();
    echo $productos->getResponse();

?>