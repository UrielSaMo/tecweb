<?php
    require_once 'API/Productos.php';

    $buscar = new Productos('marketzone');
    $buscar->search( $_GET['search'] );
    echo $buscar->getResponse();
?>