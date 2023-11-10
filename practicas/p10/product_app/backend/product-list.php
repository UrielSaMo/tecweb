<?php
    use API\Leer\Leer;

    require_once __DIR__.'/API/start.php';

    $leer = new Leer('marketzone');
    $leer->list();
    echo $leer->getResponse();
?>