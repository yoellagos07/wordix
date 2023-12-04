<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Lagos Yoel FAI-5013 yoellagos6@gmail.com . Villa Milena FAI-5012 milenaavgmail.com . TUDW . yoellagos07 */
/* ****COMPLETAR***** */


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * funcion que crea un menu 
 * @return int $opcion
 */
function mostrarMenu(){
    //INT $opcion
    echo "************************\n";
    echo "1. Jugar al wordix con una palabra elegida\n";
    echo "2. Jugar al wordix con una palabra aleatoria \n";
    echo "3. Mostrar una partida\n";
    echo "4. Mostrar la primer partida ganadora\n";
    echo "5. Mostrar resumen de Jugador\n";
    echo "6. Mostrar listado de partidas ordenadas por jugador y por palabra\n";
    echo "7. Agregar una palabra de 5 letras a Wordix\n";
    echo "8. salir\n";
    echo "*************************\n";
    echo "ingrese una opcion\n";
    $opcion=trim(fgets(STDIN));
    return $opcion;
}

/**
 * Obtiene una colección de palabras indexado 
 * retorna una coleccion de palabras 
 * @return array
 * 
 */
function cargarColeccionPalabras()
{
    //
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "RIVER","AUTOS","RAMON","MANOS","PERRO",
    ];

    return ($coleccionPalabras);
}
/**
 * Función para verificar si una palabra ya se jugó
 * @param array $partidas
 * @param string $palabraJugar, $nombre
 */
function yaSeJugo($partidas, $palabraJugar, $nombre) {
    //bool $palabraUsada 
    $palabraUsada=false;
    foreach ($partidas as $unaPartida) {
        if($unaPartida['jugador'] == $nombre){
            if ($unaPartida['palabraWordix'] == $palabraJugar) {
                $palabraUsada= true;
        break;
            }
        }
    }
    return $palabraUsada;
}

/**
 * Función para obtener la palabra a jugar
 * @param array $palabras
 * @param int $minimo
 * @param string 
 */ 
function palabra($palabras, $minimo) {
    // int $maximo, $indiceSeleccionado
    $maximo=count($palabras);
    // Solicitar al jugador que elija una palabra
    echo"ingrese un numero entre " .$minimo. " y ". $maximo ." para jugar con esa palabra\n";
    $indiceSeleccionado=trim(fgets(STDIN));
    while($indiceSeleccionado<$minimo || $indiceSeleccionado>$maximo){
        echo"numero invalido ingrese otro\n";
        $indiceSeleccionado=trim(fgets(STDIN));
    }
    return strtoupper($palabras[$indiceSeleccionado-1]);//devuelve la palabra en mayuscula
}

/**
 * funcion si parametros de entradas que crea una coleccion de partidas asociativa y la retorna.
 * @param array
 */
function cargarPartidas(){
    $coleccionPartidas=[];
    $coleccionPartidas[0] = ["palabraWordix"=> "QUESO" , "jugador" => "majo", "intentos"=> 0, 'puntaje' => 0];
    $coleccionPartidas[1] = ["palabraWordix"=> "CASAS" , "jugador" => "rudolf", "intentos"=> 3, 'puntaje' => 14];
    $coleccionPartidas[2] = ["palabraWordix"=> "QUESO" , "jugador" => "pink2000", "intentos"=> 6, 'puntaje' => 10];
    $coleccionPartidas[3] = ["palabraWordix"=> "RIVER" , "jugador" => "alexis03", "intentos"=> 4, 'puntaje' => 4];
    $coleccionPartidas[4] = ["palabraWordix"=> "MUJER" , "jugador" => "milena12", "intentos"=> 5, 'puntaje' => 12];
    $coleccionPartidas[5] = ["palabraWordix"=> "VERDE" , "jugador" => "majo", "intentos"=> 6, 'puntaje' => 10];
    $coleccionPartidas[6] = ["palabraWordix"=> "MELON" , "jugador" => "gloria3", "intentos"=> 2, 'puntaje' => 7];
    $coleccionPartidas[7] = ["palabraWordix"=> "GATOS" , "jugador" => "milena12", "intentos"=> 1, 'puntaje' => 15];
    $coleccionPartidas[8] = ["palabraWordix"=> "PERRO" , "jugador" => "valen78", "intentos"=> 3, 'puntaje' => 13];
    $coleccionPartidas[9] = ["palabraWordix"=> "PISOS" , "jugador" => "lola", "intentos"=> 1, 'puntaje' => 8];
    return $coleccionPartidas;
}
/**
 * funcion que recibe un valor minimo que es 1 y una coleccion de partidas y retorna un numero en el rango minimo y maximo
 * @param array $partidas
 * @param int $minimo
 * @return int $num
 */
function solicitarNumero($minimo,$partidas){
    // int $maximo, $num 
    $maximo=count($partidas);
    echo"ingrese un numero entre " .$minimo. " y ". $maximo ."\n";
    $num=trim(fgets(STDIN));
    while($num<$minimo || $num>$maximo){
        echo"numero invalido ingrese otro\n";
        $num=trim(fgets(STDIN));
    }
    return $num;
}
/**
 * funcion que recibe la coleccion de $partidas y un num que vendria a ser el indice y muestra mensajes sobre el indice ese
 * @param array $partidas 
 * @param int $num
 */
    function mostrarPartida($partidas,$num){
        //string $palabra, jugador
        //int $intentos, $puntaje 
    $palabra = $partidas[$num-1]["palabraWordix"];
    $jugador = $partidas[$num-1]["jugador"];
    $intentos = $partidas[$num-1]["intentos"];
    $puntaje = $partidas[$num-1]["puntaje"];
    echo "*************************************\n";
    echo "la partida wordix ". $num .": palabra ". $palabra ."\n";
    echo "jugador : " . $jugador. "\n";
    echo "puntaje : ". $puntaje. "\n";
    if($puntaje>0){
    echo "intentos : adivino la palabra en  ". $intentos." intentos\n";
    }else{
        echo "intentos: no adivino la palabra\n";
    }
    echo "************************************\n";
}
/**
 * funcion recibe de parametro la coleccion de partidas y el nombre del jugador 
 * y retorna el inidice de la 1ra partida ganada del jugador buscado en caso de que no lo encuentre retorna -1
 * @param array $partidas 
 * @param string $jugadorBuscado
 * @return bool 
 */
function indicePrimeraPartidaGanada($partidas, $jugadorBuscado) {
    $indiceEcontrado= -1;
    foreach ($partidas as $indice => $partida) {
        if ($partida['jugador'] == $jugadorBuscado && $partida['puntaje'] > 0) {
            $indiceEcontrado= $indice; // Se encontró la primera partida ganada
        }
    }
    return $indiceEcontrado; // El jugador no ganó ninguna partida
}
/**
 * recibe como parametro la coleccion de partidas y el indice con esos datos va extraer de la coleccion
 * de partidas con las claves los datos para mostrarlos
 * @param array $partidas 
 * @param int $indice  
 */
function primeraPartidaGanada ($partidas,$indice){
    $palabra = $partidas[$indice]["palabraWordix"];
    $jugador = $partidas[$indice]["jugador"];
    $intentos = $partidas[$indice]["intentos"];
    $puntaje = $partidas[$indice]["puntaje"];
    echo "*************************************\n";
    echo "la partida wordix ". $indice+1 .": palabra ". $palabra ."\n";
    echo "jugador : " . $jugador. "\n";
    echo "puntaje : ". $puntaje. "\n";
    echo "intentos : adivino la palabra en ". $intentos." intentos\n";
    echo "************************************\n";
}


function compararPartidas($partida1, $partida2) {
    // strcmp para comparar las cadenas en la clave 'jugador' de las dos partidas.
    $comparacionPorJugador = strcmp($partida1['jugador'], $partida2['jugador']);

    // Si las cadenas de los jugadores son iguales, se procede a comparar las cadenas en la clave 'palabraWordix'
    // Si $comparacionPorJugador es igual a 0, se retorna la comparación por palabraWordix.
    return ($comparacionPorJugador === 0) ? strcmp($partida1['palabraWordix'], $partida2['palabraWordix']) : $comparacionPorJugador;
}
/**
 * funcion recibe como parametro la coleccion de partidas y las devuelve ordenadas
 * @param array $partidas
 */
function mostrarPartidasOrdenadas($partidas) {
    //Esto ordenará el array $partidas de acuerdo con la lógica 
    //definida en la función compararPartidas, 
    //es decir, primero por jugador y luego por palabra Wordix en caso de empate. 
    uasort($partidas, 'compararPartidas');
    //Finalmente, se imprime el array ordenado con print_r($partidas).
    print_r($partidas);
}
/**
 * esta funcion cuenta los intentos, las victorias, puntajes y calcula el porcentaje de victorias
 * y retorna un arreglo de resumen para poder usar en otra funcion
 * 
 * @param array $partidas
 * @param string $nombre
 * @return array
 */
function coleccionResumenJugador($partidas,$nombre){
//$unaPartida = ["palabraWordix"=> "QUESO" , "jugador" => "majo", "intentos"=> 0, 'puntaje' => 0];

    $contPartidas=0;
    $contVictorias=0;
    $sumaPuntaje=0;
    $contInt1=0;
    $contInt2=0;
    $contInt3=0;
    $contInt4=0;
    $contInt5=0;
    $contInt6=0;

    //hola
    foreach ($partidas as $unaPartida) {
        if ($unaPartida['jugador'] == $nombre){
            $contPartidas=$contPartidas+1;
            if($unaPartida['puntaje'] > 0){
                $contVictorias=$contVictorias+1;
                $sumaPuntaje=$sumaPuntaje+$unaPartida['puntaje'];
            }
            if($unaPartida['intentos']== 1){
                $contInt1=$contInt1+1;
            }else if($unaPartida['intentos']== 2){
                $contInt2=$contInt2+1;
            }else if($unaPartida['intentos']== 3){
                $contInt3=$contInt3+1;
            }else if($unaPartida['intentos']== 4){
                $contInt4=$contInt4+1;
            }else if($unaPartida['intentos']==5){
                $contInt5=$contInt5+1;
            }else if($unaPartida['intentos']==6){
                $contInt6=$contInt6+1;
            } 
        }
    }
    if($contVictorias>0){
    $victorias=$contVictorias*100/$contPartidas;
    }else{
    $victorias = 0;
    }   
    //arreglo asociativo
    $jugadorResumen = [
        'jugador' => $nombre,
        'partidas' => $contPartidas,
        'puntaje' => $sumaPuntaje,
        'victorias' => $contVictorias,
        'porcentaje' => $victorias,
        'intento1' => $contInt1,
        'intento2' => $contInt2,
        'intento3' => $contInt3,
        'intento4' => $contInt4,
        'intento5' => $contInt5,
        'intento6' => $contInt6,
    ];

    return $jugadorResumen;


}
/**
 * esta funcion le ingresa como parametro un arreglo y le extrae las claves para asignarlas en
 * variables
 * @param array $resumen
 */
function resumenJugador($resumen){
    $jugador= $resumen['jugador'];
    $partidas= $resumen['partidas'];
    $puntaje= $resumen['puntaje'];
    $contVictorias = $resumen['victorias'];
    $victorias = $resumen ['porcentaje'];
    $intento1= $resumen['intento1'];
    $intento2= $resumen['intento2'];
    $intento3= $resumen['intento3'];
    $intento4= $resumen['intento4'];
    $intento5= $resumen['intento5'];
    $intento6= $resumen['intento6'];
    echo "********************************\n";
    echo "jugador: ". $jugador. "\n";
    echo "partidas: ". $partidas. "\n";
    echo "puntaje total: ". $puntaje. "\n";
    echo "victorias: ". $contVictorias ."\n";
    echo "el porcentaje de victorias es: ". $victorias. "%\n";
    echo "adivinadas:\n";
            echo "intento 1: " .$intento1. "\n";
            echo "intento 2: " .$intento2. "\n";
            echo "intento 3: " .$intento3. "\n";
            echo "intento 4: " .$intento4. "\n";
            echo "intento 5: " .$intento5. "\n";
            echo "intento 6: " .$intento6. "\n";
    echo "*************************************";

}

/**
 * Una función que le pida al usuario ingresar una palabra de 5 letras, y retorne la palabra.
 * @return $palabra
 */

function ingresarPalabra (){
    //string $palabra
    $palabra = '';
    do {
        echo "ingrese una palabra de 5 letras\n";
        $palabra = trim(fgets(STDIN));
    }while (strlen($palabra) !=5);
    return strtoupper($palabra);
}

/**
 * @param array $palabras
 * @param string $palabraN
 * @return bool $encontrada
 */
function existePalabra ($palabras, $palabraN){
    // bool $encontrada
    // int $i, $cant
    $encontrada=false;
    $i=0;
    $cant= count($palabras);
    while ($i<$cant  &&  $encontrada==false) {
        if ($palabras [$i] == $palabraN){
            $encontrada= true;
        }

        $i++;
    }

    return $encontrada;
}
/**
 * esta funcion trae una palabra nueva y se agrega en la coleccion de palabras
 * @param array $palabras
 * @param string $palabraN
 * @return array
 */
function agregarPalabra ($palabras, $palabraN){
    // int $nuevaPos
    $nuevaPos=count($palabras);
    $palabras [$nuevaPos] = strtoupper($palabraN);/*hace que la palabra sea mayus*/
    return $palabras;
}

/**
 * retorna el nombre en minuscula
 * @return string $nombre
 */
function solicitarJugador (){
    echo "ingrese el nombre del jugador\n";
    $nombre = trim(fgets(STDIN));
    return strtolower($nombre);//pasa el nombre a minuscula
}


/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/


//Inicialización de variables:
$llamaPartidas=cargarPartidas();
$min=1;
$coleccionPalabras = cargarColeccionPalabras();



do {
    $opcion = mostrarMenu();

    
    switch ($opcion) {
        case 1: 
            $llamaNombreJugador= solicitarJugador();
            $llamaPalabra = palabra($coleccionPalabras, $min);
            $llamaYaSeJugo=yaSeJugo($llamaPartidas, $llamaPalabra, $llamaNombreJugador);
            if ($llamaYaSeJugo == true) {
                echo "La palabra ya se jugó, elige otra.\n";
            } else {
                $partida = jugarWordix($llamaPalabra, $llamaNombreJugador);
                $llamaPartidas[count($llamaPartidas)] = $partida;
            }
            break;

        case 2: 
            // La función array_rand devuelve un índice aleatorio de un array. 
            //En este caso, se utiliza para obtener un índice aleatorio del array $coleccionPalabras.
            $llamaNombreJugador= solicitarJugador();
            $palabraAleatoria =  $coleccionPalabras[array_rand($coleccionPalabras)];
            $llamaYaSeJugo=yaSeJugo($llamaPartidas, $palabraAleatoria, $llamaNombreJugador);
            if ($llamaYaSeJugo == true) {
                echo "La palabra ya se jugó.\n";
            } else {
                $partida = jugarWordix($palabraAleatoria, $llamaNombreJugador);
                $llamaPartidas[count($llamaPartidas)] = $partida;
            }
            break;

        case 3:
            $llamaSolicitarNumero=solicitarNumero($min,$llamaPartidas);
            $llama=mostrarPartida($llamaPartidas,$llamaSolicitarNumero);
            echo $llama."\n";
            break;
        case 4:
            $llamaNombreJugador= solicitarJugador();
            $llamaIndice=indicePrimeraPartidaGanada($llamaPartidas,$llamaNombreJugador);
            if ($llamaIndice !== -1) {
                $llamaPrimeraPartidaGanada=primeraPartidaGanada($llamaPartidas,$llamaIndice);
                echo $llamaPrimeraPartidaGanada;
            } else {
                echo "El jugador ". $nombre. " no ganó ninguna partida";
            }
            break;
        case 5:
            $llamaNombreJugador = solicitarJugador();
            $llamaColeccionResumen=coleccionResumenJugador($llamaPartidas,$llamaNombreJugador);
            $llamaResumen=resumenJugador($llamaColeccionResumen);
            echo $llamaResumen;

            break;
        case 6:
            // Mostrar las partidas ordenadas por nombre del jugador y por palabra
            mostrarPartidasOrdenadas($llamaPartidas);
            break;
        case 7:
            $nuevaPalabra = ingresarPalabra();
            $existe= existePalabra($coleccionPalabras, $nuevaPalabra);
            if ($existe == true ) {
                echo "la palabra ya existe";
            }else{
                $coleccionPalabras = agregarPalabra($coleccionPalabras, $nuevaPalabra);
            }
            break;

    }
    echo "\n \n \n";
} while ($opcion != 8);
echo "gracias para usar wordix";

