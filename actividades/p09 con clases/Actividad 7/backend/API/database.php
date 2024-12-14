<?php

abstract class DataBase {
    protected $conexion;

    public function __construct($database="marketzone") {
        $this->conexion = @mysqli_connect(
            'localhost',
            'root',
            '137731',
            $database
        );
    
        if(!$this->conexion) {
            die('¡Base de datos NO conextada!');
        }
    }
}
?>