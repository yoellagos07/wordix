<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
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
    echo "7.Agregar una palabra de 5 letras a Wordix\n";
    echo "8. salir\n";
    echo "*************************\n";
    echo "ingrese una opcion\n";
    $opcion=trim(fgets(STDIN));
    return $opcion;
}

/**
 * Obtiene una colección de palabras  
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
 * funcion que recibe como parametro una coleccion de palabras y retorna palabra con el indice
 * @param array $palabras
 */
function palabra($palabras){
    $n=count($palabras);
    echo "Seleccione una palabra de la colección:\n";
    // Mostrar la lista de palabras disponibles
    foreach ($palabras as $indice => $palabra) {
        echo $indice. $palabra . "\n";
    }

    // Solicitar al jugador que elija una palabra
    echo "Ingrese el número de la palabra: ";
    $indiceSeleccionado = trim(fgets(STDIN));
    while($indiceSeleccionado<0 || $indiceSeleccionado>$n){
        echo"numero invalido ingrese otro\n";
        $indiceSeleccionado=trim(fgets(STDIN));
    }
    return strtoupper($palabras[$indiceSeleccionado]);//devuelve la palabra en mayuscula
}


/**
 * funcion si parametros de entradas que crea una coleccion de partidas indexeada asociativa y la retorna.
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
 * funcio que recibe la coleccion de $partidas y un num que vendria hacer el indice y muestra mensajes sobre el indice ese
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
 * funcion recibe de parametro 
 */
function indicePrimeraPartidaGanada($partidas, $jugadorBuscado) {
    foreach ($partidas as $indice => $partida) {
        if ($partida['jugador'] == $jugadorBuscado && $partida['puntaje'] > 0) {
            return $indice; // Se encontró la primera partida ganada
        }
    }

    return -1; // El jugador no ganó ninguna partida
}
/**
 * 
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
    //strcmp para comparar las cadenas en la clave 'jugador' de las dos partidas.
    $comparacionPorJugador = strcmp($partida1['jugador'], $partida2['jugador']);
    //Si $comparacionPorJugador no es igual a 0, significa que las cadenas son diferentes,
    // y en ese caso, la función retorna ese valor.
    //Esto significa que el arreglo $partidas se ordenará primero por el nombre del jugador.
    if ($comparacionPorJugador !== 0) {
        return $comparacionPorJugador;
    }
    //Después, si las cadenas de los jugadores son iguales,
    // se procede a comparar las cadenas en la clave 'palabraWordix'
    return strcmp($partida1['palabraWordix'], $partida2['palabraWordix']);
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
    $victorias=$contVictorias*100/$contPartidas;
    
    $jugadorResumen = [
        'jugador' => $nombre,
        'partidas' => $contPartidas,
        'puntaje' => $sumaPuntaje,
        'victorias' => $victorias,
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
 * 
 */
function resumenJugador($resumen){
    $jugador= $resumen['jugador'];
    $partidas= $resumen['partidas'];
    $puntaje= $resumen['puntaje'];
    $victoria= $resumen['victorias'];
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
    echo "el porcentaje de victorias es: ". $victoria. "%\n";
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
    $palabra = '';
    do {
        echo "ingrese una palabra de 5 letras\n";
        $palabra = trim(fgets(STDIN));
    }while (strlen($palabra) !=5);
    return strtoupper($palabra);
}

function agregarPalabra ($palabras, $palabraN){
    //$palabras = ["MUJER", "QUESO"]
    //                0        1       2

    $nuevaPos=count($palabras);
    $palabras [$nuevaPos] = /*hace que la palabra sea mayus*/strtoupper($palabraN);
    return $palabras;
}

function existePalabra ($palabras, $palabraN){
    
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

function solicitarJugador (){
    echo "ingrese el nombre del jugador\n";
    $nombre = trim(fgets(STDIN));
    return strtolower($nombre);//pasa el nombre a minuscula
}


/* ****COMPLETAR***** */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/


//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);

$llamaPartidas=cargarPartidas();
$min=1;
$coleccionPalabras = cargarColeccionPalabras();



do {
    $opcion = mostrarMenu();

    
    switch ($opcion) {
        case 1: 
            $llamaNombreJugador= solicitarJugador();
            $llamaPalabra= palabra($coleccionPalabras); 
            $partida = jugarWordix($llamaPalabra, $llamaNombreJugador);
            $llamaPartidas[count($llamaPartidas)] = $partida;
            break;

        case 2: 
            // La función array_rand devuelve un índice aleatorio de un array. 
            //En este caso, se utiliza para obtener un índice aleatorio del array $coleccionPalabras.
            $llamaNombreJugador= solicitarJugador();
            $palabraAleatoria =  $coleccionPalabras[array_rand($coleccionPalabras)];
            $partida = jugarWordix($palabraAleatoria,$llamaNombreJugador);  
            $llamaPartidas[count($llamaPartidas)] = $partida;
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
                echo "El jugador $nombre no ganó ninguna partida";
            }
            break;
        case 5:
            $llamaNombreJugador= solicitarJugador();
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
            //echo "la palabra es: " .$llamaF. "\n";
            
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

