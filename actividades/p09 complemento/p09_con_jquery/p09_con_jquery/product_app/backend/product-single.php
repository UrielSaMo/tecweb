<?php
require_once 'API/Productos.php';
    
    $single = new Productos('marketzone');
    $single->single($_POST['id']);
    echo $single->getResponse();
?>