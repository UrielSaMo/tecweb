<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang= "es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Practica 3: Manejo de variables con PHP </title>
</head>
<body>
    <h2>Iniciso 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>
    <?php
        //Inicio de codigo PHP
        $_myvar= 1;
        $_7var=2;
        // myvar -> No es una variable validad porque no inicia con $
        $myvar=4;
        $var7=5;
        $_element1;
        // $house*5 -> No es una variable valida porque hace referencia a una operación
        echo '<ul>';
        echo '<li>$_myvar es válido, debido a que inicia con $ y seguido de un guión bajo </li>';
        echo '<li>$_7var es válido, debido a que inicia con $ y seguido un guión bajo</li>';
        echo '<li>$myvar es válido, debido a que inicia con con $ y seguido de una letra</li>';
        echo '<li>$var7 es válido, debido a que inicia con con $ y seguido de una letra</li>';
        echo '<li>$_element1 es válido, debido a que inicia con con $ y seguido de una letra</li>';
        echo '</ul>';
    ?>
</body>
</html>