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
        $a2 = "ManejadorSQL";
        $b2 = 'MySQL';
        $c2 = &$a2;
    ?>
    <p>Ahora muestra el contenido de cada variable</p>
    <?php
    echo '<ul>';
    echo 'El contenido de $a es: '.$a2;
    echo '<br>';
    echo 'El contenido de $b es: '.$b2;
    echo '<br>';
    echo 'El contenido de $c es: '.$c2;
    echo '</ul>';
    ?>
    <p>Agrega al código actual las siguientes asignaciones:</p>
    <p>$a = "PHP server";</p>
    <p>$b = &$a;</p>
    <?php
        $a2 = "PHP server";
        $b2 = &$a2;
    ?>
    <p>Vuelve a mostrar el contenido de cada uno</p>
    <?php
         echo '<ul>';
         echo 'El contenido de $a es: '.$a2;
         echo '<br>';
         echo 'El contenido de $b es: '.$b2;
         echo '</ul>';
    ?>
    <p>Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</p>
    <p>Lo que paso en el segundo bloque de asignaciones, fue sustituir el contenido que tenia $a y $b del primer bloque de asignación, al mostrar 
        los resultados en el navegador ambas variables tienen el mismo contenido debido a que $b hace referencia al contenido de $a.
    </p>
    <h2>Inciso 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
        verificar la evolución del tipo de estas variables (imprime todos los componentes de los
        arreglo):
    </p>
    <p>$a = “PHP5”;</p>
    <p>$z[] = &$a;</p>
    <p>$b = "5a version de PHP";</p>
    <p>$c = $b*10;</p>
    <p>$a .= $b;</p>
    <p> $b *= $c;</p>
    <p>$z[0] = “MySQL”;</p>

    <ul>
        <li>
            <?php
                $a3 = "PHP5";
                echo 'Contenido de $a3 es: ' .$a3;
            ?>
        </li>
        <li>
            <?php
                $z3[] = &$a3;
                echo '$z3[] contiene: ';
                var_dump($z3);
            ?>
        </li>
        <li>
            <?php
                $b3 = "5a version de PHP";
                echo '$b3 contiene: '.$b3;
            ?>
        </li>
        <li>
            <?php
                echo '$c3 contiene: ';
                echo @$c3 = $b3*10;
            ?>
        </li>
        <li>
            <?php
                $a3 .= $b3;
                echo '$a3 contiene: ';
                echo $a3;
            ?>
        </li>
        <li>
            <?php
                 echo '$b3 contiene: ';
                echo @$b3 *= $c3;

            ?>
        </li>
        <li>
            <?php
                $z3[0] = "MySQL";
                echo '$z[0] contiene: ';
                var_dump($z3);
            ?>
        </li>
    </ul>
    <h2>Inciso 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
        la matriz $GLOBALS o del modificador global de PHP.</p>
    <?php
        $a4 = "PHP5";
        $z4[] = &$a4;
        $b4 = "5a version de PHP";
        @$c4 = $b4*10;
        $a4 .= $b4;
        @$b4 *= $c4;
        $z4[0] = "MySQL";

        function varglobal(){
            global $a4, $z4, $b4, $c4, $m;
            $m = $a4.'<br>'.$b4.'<br>'.var_dump($z4).'<br>'.$c4.'<br>'.$z4[0];

        }
        varglobal();
        echo $m;
    ?>
    <h2>Inciso 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <p>$a = “7 personas”;</p>
    <p>$b = (integer) $a;</p>
    <p>$a = “9E3”;</p>
    <p>$c = (double) $a;</p>
    <?php
        $a5 = "7 personas";
        $b5 = (integer) $a5;
        $a5 = "9E3";
        $c5 = (double) $a5;
        echo '$a5: '.$a5.'<br>';
        echo '$b5: '.$b5.'<br>';
        echo '$c5: '.$c5.'<br>';
    ?>
    <h2>Inciso 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump(<datos>).</p>
    <p>Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:</p>
        <?php
        $a6 = "0";
        $b6 = "TRUE";
        $c6 = FALSE;
        $d6 = ($a6 OR $b6);
        $e6 = ($a6 AND $c6);
        $f6 = ($a6 XOR $b6);
        echo '$a: ';
        var_dump($a6);
        echo '<br>$b: ';
        var_dump($b6);
        echo '<br>$c: ';
        var_dump($c6);
        echo '<br>$d: ';
        var_dump($d6);
        echo '<br>$e: ';
        var_dump($e6);
        echo '<br>$f: ';
        var_dump($f6);

        $c6_bool = boolval($c6);
        $e6_bool = boolval($e6);
        echo '<br>';
        echo 'El valor booleano de $c6 es: ' . (@$c_bool6 ? 'TRUE' : 'FALSE') . "<br>";
        echo 'El valor booleano de $e6 es: ' . (@$e_bool6? 'TRUE' : 'FALSE') . "<br>";
    ?>
    <h2>Inciso 7</h2>
    <p>Usando la variable predefinida $_SERVER, determina lo siguiente:</p>
    <p>La versión de Apache y PHP</p>
    <p>El nombre del sistema operativo (servidor)</p>
    <p>El idioma del navegador (cliente).</p>
    <?php
        $apacheVersion = $_SERVER['SERVER_SOFTWARE'];
        $phpVersion = phpversion();
        
        echo 'Versión de Apache: ' . $apacheVersion . '<br>';
        echo 'Versión de PHP: ' . $phpVersion . '<br>';
        
        $serverOS = php_uname();
        echo 'El nombre del sistema operativo (servidor): ' . $serverOS . '<br>';

        $idioma = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo $idioma;
    ?>
</body>
</html>