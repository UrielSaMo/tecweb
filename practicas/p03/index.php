<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang= "es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Practica 3: Manejo de variables con PHP </title>
</head>
<body>
    <h2>Inciso 1</h2>
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
    <h2>Inciso 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$a = “ManejadorSQL”;</p>
    <p>$b = 'MySQL';</p>
    <p>$c = &$a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
    ?>
    <p>Ahora muestra el contenido de cada variable</p>
    <?php
    echo '<ul>';
    echo 'El contenido de $a es: '.$a;
    echo '<br>';
    echo 'El contenido de $b es: '.$b;
    echo '<br>';
    echo 'El contenido de $c es: '.$c;
    echo '</ul>';
    ?>
    <p>Agrega al código actual las siguientes asignaciones:</p>
    <p>$a = "PHP server";</p>
    <p>$b = &$a;</p>
    <?php
        $a = "PHP server";
        $b = &$a;
    ?>
    <p>Vuelve a mostrar el contenido de cada uno</p>
    <?php
         echo '<ul>';
         echo 'El contenido de $a es: '.$a;
         echo '<br>';
         echo 'El contenido de $b es: '.$b;
         echo '</ul>';
    ?>
    <p>Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</p>
    <p>Lo que paso en el segundo bloque de asignaciones, fue sustituir el contenido que tenia $a y $b del primer bloque de asignación, al mostrar 
        los resultados en el navegador ambas variables tienen el mismo contenido debido a que $b hace referencia al contenido de $a.
    </p>
</body>
</html>