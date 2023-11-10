<?php
    use API\Eliminar\Eliminar;
    require_once __DIR__.'/API/start.php';

    $eliminar = new Eliminar('marketzone');
    $eliminar->delete( $_POST['id'] );
    echo $eliminar->getResponse();
?>