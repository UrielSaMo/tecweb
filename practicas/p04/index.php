<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.1//EN”
“http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd”>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang= "es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Practica 4: Manejo de variables con PHP </title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>
     <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por:</p>
    <p>impar, par, impar</p>
    <p>Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y
    3 el número de columnas. Al final muestra el número de iteraciones y la cantidad de
    números generados:</p>
    <?php
        $ban=true;
        $total_num=0;
        $iteraciones=0;
        do{
            $numero1 = rand(1, 999);
            $numero2 = rand(1, 999);
            $numero3 = rand(1, 999);
            $iteraciones ++;
            $total_num += 3;

            $numeros_alt[] = [$numero1, $numero2, $numero3] ;

            if ($numero1 % 2 != 0 && $numero2 % 2 == 0 && $numero3 % 2 != 0) {
                $ban=false; 
            }
        }
        while ($ban); 
        //foreach recorrer el array, la cual son los elementos de fila que contiene los elementos de numeros_alt[]
        foreach ($numeros_alt as $fila) {
            //implode concatena los elementos en fila en este caso los array y son separados con br
            echo implode("  ", $fila) . "<br>";
        }
        echo "Número de iteraciones: $iteraciones<br>";
        echo "Total de números generados: $total_num<br>"
    ?>
     <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>
    <p>Crear una variante de este script utilizando el ciclo do-while.</p>
    <p>El número dado se debe obtener vía GET.</p>

    <?php
     if (isset($_GET['numero2'])) {
        $num = $_GET['numero2'];


        $numeroalt = rand(1, 100); 
        echo "Número Ingresado: $num <br> ";

        $esMultiplo = true;

        do {
            if ($numeroalt % $num == 0) {
                echo "Número aleatorio generado: $numeroalt <br>";
                echo "$num es un múltiplo de $numeroalt";
                $esMultiplo = false;
            }
            else{
                $numeroalt = rand(1, 100);
            }

        } while ($esMultiplo);
    }

    ?>
    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’
    a la ‘z’. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner
    el valor en cada índice. Es decir:</p>
    <pre>
        [97] => a
        [98] => b
        [99] => c
    </pre>
    <p>Crea el arreglo con un ciclo for</p>
    <p>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</p>
    <?php

        $arreglo = array();

        for ($c_ascii = 97; $c_ascii <= 122; $c_ascii++) {
            //chr() se usa para convertir un número  de código ASCII (que se encuentra en $arreglo) en el carácter correspondiente. 
            $arreglo[$c_ascii] = chr($c_ascii); 
        }

        echo '<table border="1">';
        echo "<tr>";
        echo '<td>Índice</td><td>Letra </td>';
        echo "</tr>";
        foreach ($arreglo as $arr_indice => $arreglo) {
            echo "<tr>";
            echo "<td>$arr_indice</td><td>$arreglo</td>";
            echo "</tr>";
        }

        echo '</table>';
    ?>
     <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
    sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
    bienvenida apropiado. Por ejemplo: </p>
    <p>Bienvenida, usted está en el rango de edad permitido.</p>
    <p>En caso contrario, deberá devolverse otro mensaje indicando el error.</p>
    <p>Los valores para $edad y $sexo se deben obtener por medio de un formulario en
    HTML.</p>
    <p>Utilizar el la Variable Superglobal $_POST (revisar documentación).</p>

    <form action="index.php" method="post">
        <label for="edad">Indique su edad: </label>
        <input type="number" id="edad" name="edad" required>
        <br>
        <label for="sexo">Indique su sexo: </label>
        <input type="text" id="sexo" name="sexo" required>
        <br>
        <input type="submit" value="Enviar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];

        if($edad >= 18 && $edad <= 35 && $sexo == "femenino"){
            echo "Bienvenida, usted está en el rango de edad permitido.<br>";
        }
        else{
            echo "ERROR <br>";
        }
        echo "Edad: $edad<br>";
        echo "Sexo: $sexo<br>";
    }
    ?>
    <h2>Ejercicio 6</h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
    una ciudad. Cada vehículo debe ser identificado por:</p>
    <pre>
        * Matricula
        * Auto
            - Marca
            - Modelo (año)
            - Tipo (sedan|hachback|camioneta)
        * Propietario 
            - Nombre 
            - Ciudad 
            - Dirección
    </pre>
    <p>La matrícula debe tener el siguiente formato LLLNNNN, donde las L pueden ser letras de
    la A-Z y las N pueden ser números de 0-9.</p>
    <p>Para hacer esto toma en cuenta las siguientes instrucciones:</p>
    <ul>
        <li>Crea en código duro el registro para 15 autos</li>
        <li>Utiliza un único arreglo, cuya clave de cada registro sea la matricula</li>
        <li>Lógicamente la matricula no se puede repetir.</li>
        <li>Los datos del Auto deben ir dentro de un arreglo.</li>
        <li>Los datos del Propietario deben ir dentro de un arreglo.</li>
    </ul>
    <p>Usa print_r para mostrar la estructura general del arreglo, que luciría de forma similar al
    siguiente ejemplo:</p>
    <pre>
    Array ( [UBN6338] => Array ( [Auto] => Array ( [marca] => HONDA [modelo] => 2020
    [tipo] => camioneta ) [Propietario] => Array ( [nombre] => Alfonzo Esparza [ciudad]
    => Puebla, Pue. [direccion] => C.U., Jardines de San Manuel ) ) [UBN6339] => Array
    ( [Auto] => Array ( [marca] => MAZDA [modelo] => 2019 [tipo] => sedan ) [Propietario]
    => Array ( [nombre] => Ma. del Consuelo Molina [ciudad] => Puebla, Pue. [direccion]
    => 97 oriente ) ) )
    </pre>
    <p>Escrito de forma más ordenada:</p>
    <pre>
    Array (
    [UBN6338] =>
        Array (
            [Auto] => Array (
                [marca] => HONDA [modelo] => 2020 [tipo] => camioneta
            )
            [Propietario] => Array (
                [nombre] => Alfonzo Esparza [ciudad] => Puebla, Pue. [direccion]
                => C.U., Jardines de San Manuel
        )
    )
    [UBN6339] =>
        Array (
            [Auto] => Array (
                [marca] => MAZDA [modelo] => 2019 [tipo] => sedan
            )
            [Propietario] => Array (
                [nombre] => Ma. del Consuelo Molina [ciudad] => Puebla, Pue.
            [direccion] => 97 oriente
            )
        )
    )
    </pre>
    <p>Finalmente crea un formulario simple donde puedas consultar la información:</p>
    <ul>
        <li>Por matricula de auto.</li>
        <li>De todos los autos registrados.</li>
    </ul>

    <?php
        $registro = array();
        //----------------------1------------------------
        $registro['ABC1234'] = array(
            'Auto' => array(
                'Marca' => "Chevrolet",
                'Modelo'  => "2010",
                'Tipo'  => "Camioneta"
            ),
            'Propietario' => array(
                'Nombre' => "Axel Luna Gomez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Circuito San Pablo II"
            )
        ); 
         //----------------------2------------------------
         $registro['BBC1234'] = array(
            'Auto' => array(
                'Marca' => "Audi",
                'Modelo'  => "2015",
                'Tipo'  => "Familiar "
            ),
            'Propietario' => array(
                'Nombre' => "Juan Pérez García",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Calle Primavera #123"
            )
        );        
        //----------------------3------------------------
        $registro['CBC1234'] = array(
            'Auto' => array(
                'Marca' => "Nissan",
                'Modelo'  => "2013",
                'Tipo'  => "Coupe"
            ),
            'Propietario' => array(
                'Nombre' => "Luis González Martínez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Carrera 7 #890"
            )
        );
        //----------------------4------------------------
        $registro['DBC1234'] = array(
            'Auto' => array(
                'Marca' => "Nissan",
                'Modelo'  => "2023",
                'Tipo'  => "Camioneta"
            ),
            'Propietario' => array(
                'Nombre' => "Ana Martínez Rodríguez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Paseo de la Luna #2345"
            )
        ); 
        //----------------------5------------------------
        $registro['EBC1234'] = array(
            'Auto' => array(
                'Marca' => "BMW",
                'Modelo'  => "2017",
                'Tipo'  => "Deportivo"
            ),
            'Propietario' => array(
                'Nombre' => "Carlos López Sánchez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Avenida Principal #6789"
            )
        ); 
        //----------------------6------------------------
        $registro['FBC1234'] = array(
            'Auto' => array(
                'Marca' => "Audi",
                'Modelo'  => "2014",
                'Tipo'  => "Camioneta"
            ),
            'Propietario' => array(
                'Nombre' => "Laura González Pérez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Callejón de las Flores #1011"
            )
        ); 
        //----------------------7------------------------
        $registro['GBC1234'] = array(
            'Auto' => array(
                'Marca' => "Chevrolet",
                'Modelo'  => "2015",
                'Tipo'  => "Coupe"
            ),
            'Propietario' => array(
                'Nombre' => "Pedro Sánchez Fernández",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Boulevard de los Pájaros #1213"
            )
        ); 
        //----------------------8------------------------
        $registro['HBC1234'] = array(
            'Auto' => array(
                'Marca' => "Audi",
                'Modelo'  => "2011",
                'Tipo'  => "Camioneta"
            ),
            'Propietario' => array(
                'Nombre' => "Teresa Ramírez Gonzáleza",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Camino del Bosque #1415"
            )
        ); 
        //----------------------9------------------------
        $registro['IBC1234'] = array(
            'Auto' => array(
                'Marca' => "Ford",
                'Modelo'  => "2012",
                'Tipo'  => "Familiar "
            ),
            'Propietario' => array(
                'Nombre' => "Javier Fernández López",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Calle del Mar #1617"
            )
        ); 
        //----------------------10------------------------
        $registro['JBC1234'] = array(
            'Auto' => array(
                'Marca' => "Ford",
                'Modelo'  => "2019",
                'Tipo'  => "Deportivo"
            ),
            'Propietario' => array(
                'Nombre' => "Rosa Torres Pérez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Ruta del Río #1819"
            )
        ); 
        //----------------------11------------------------
        $registro['KBC1234'] = array(
            'Auto' => array(
                'Marca' => "Toyota",
                'Modelo'  => "2020",
                'Tipo'  => "Camioneta"
            ),
            'Propietario' => array(
                'Nombre' => "Alejandro Ruiz Martínez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Avenida de las Montañas #2021"
            )
        ); 
        //----------------------12------------------------
        $registro['LBC1234'] = array(
            'Auto' => array(
                'Marca' => "Audi",
                'Modelo'  => "2015",
                'Tipo'  => "Convertible"
            ),
            'Propietario' => array(
                'Nombre' => "Carmen Vargas Rodríguez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Callejuela de la Playa #2223"
            )
        ); 
        //----------------------13------------------------
        $registro['MBC1234'] = array(
            'Auto' => array(
                'Marca' => "Ford",
                'Modelo'  => "2010",
                'Tipo'  => "Familiar "
            ),
            'Propietario' => array(
                'Nombre' => "Sergio Jiménez López",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Paseo de los Cerezos #2425"
            )
        ); 
        //----------------------14------------------------
        $registro['NBC1234'] = array(
            'Auto' => array(
                'Marca' => "Audi",
                'Modelo'  => "2018",
                'Tipo'  => "Coupe"
            ),
            'Propietario' => array(
                'Nombre' => "Isabel Mendoza García",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Carretera Vieja #2627"
            )
        ); 
        //----------------------15------------------------
        $registro['OBC1234'] = array(
            'Auto' => array(
                'Marca' => "Toyota",
                'Modelo'  => "2016",
                'Tipo'  => "Familiar "
            ),
            'Propietario' => array(
                'Nombre' => "Manuel Castro Ramírez",
                'Ciudad'  => "Puebla",
                'Direccion'  => "Camino del Arco Iris #2829"
            )
        ); 

        echo "Impresión del arreglo<pre>";
        print_r($registro);
        echo "</pre>";
    ?>;
    <form method="post" action="index.php">
        <label for="matricula">Matrícula del Auto:</label>
        <input type="text" id="matricula" name="matricula">
        <input type="submit" value="Consultar">
    </form>
    <?php
        $ban2=true;
        $matricula="11111";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $matricula=($_POST["matricula"]);
           // if (isset($registro[$matricula])) {
           //     print_r($registro[$matricula]);
          //  } 
          foreach ($registro as $matricula_ => $info) {
            if($matricula == $matricula_){
                echo "Informacion de la matricula  $matricula_:";
                echo "<pre>";
                print_r($info);
                echo "</pre>";
                $ban2 = true;
                break;
            }else{
                $ban2 = false;
            }
        }
    }
    ?>
</body>
</head>