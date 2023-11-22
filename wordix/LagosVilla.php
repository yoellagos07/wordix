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
 * @return int $opcion
 */
function mostrarMenu(){
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
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "RIVER","AUTOS","RAMON","MANOS","PERROS",
    ];

    return ($coleccionPalabras);
}
function palabrasAleatorias()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "RIVER","AUTOS","RAMON","MANOS","PERROS",
    ];

    return $coleccionPalabras[array_rand($coleccionPalabras)];
}
/**
 * 
 */
function cargarPartidas(){
    $coleccionPartidas=[];
    $coleccionPartidas[0] = ["palabraWordix"=> "QUESO" , "jugador" => "majo", "intentos"=> 0, 'puntaje' => 0];
    $coleccionPartidas[1] = ["palabraWordix"=> "CASAS" , "jugador" => "rudolf", "intentos"=> 3, 'puntaje' => 14];
    $coleccionPartidas[2] = ["palabraWordix"=> "QUESO" , "jugador" => "pink2000", "intentos"=> 6, 'puntaje' => 10];
    $coleccionPartidas[3] = ["palabraWordix"=> "RIVER" , "jugador" => "alexis03", "intentos"=> 7, 'puntaje' => 4];
    $coleccionPartidas[4] = ["palabraWordix"=> "MUJER" , "jugador" => "milena12", "intentos"=> 8, 'puntaje' => 12];
    $coleccionPartidas[5] = ["palabraWordix"=> "VERDE" , "jugador" => "majo", "intentos"=> 6, 'puntaje' => 10];
    $coleccionPartidas[6] = ["palabraWordix"=> "MELON" , "jugador" => "gloria3", "intentos"=> 2, 'puntaje' => 7];
    $coleccionPartidas[7] = ["palabraWordix"=> "GATOS" , "jugador" => "milena12", "intentos"=> 1, 'puntaje' => 15];
    $coleccionPartidas[8] = ["palabraWordix"=> "PERRO" , "jugador" => "valen78", "intentos"=> 9, 'puntaje' => 13];
    $coleccionPartidas[9] = ["palabraWordix"=> "PISOS" , "jugador" => "lola", "intentos"=> 1, 'puntaje' => 8];
    return $coleccionPartidas;
}
/**
 * 
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
 * 
 */
function mostrarPartida($partidas,$num){

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
 * 
 */
function indicePrimeraPartidaGanada($partidas, $jugadorBuscado) {
    foreach ($partidas as $indice => $partida) {
        if ($partida['jugador'] === $jugadorBuscado && $partida['puntaje'] > 0) {
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
/**
 * funcion que recibe como parametro la coleccion de parrtidas y el nombre de un jugador
 * y retorna el resumen del jugador
 * @param array $partidas
 * @param string $nombre
 */
function obtenerResumenJugador($partidas, $nombreJugador) {
    foreach ($partidas as $partida) {
        if ($partida['jugador'] == $nombreJugador) {
            return $partida;
        }
    }

    // Si no se encuentra al jugador, devolver un valor nulo o manejarlo de acuerdo a tus necesidades
    return null;
}

function mostrarResumenJugador($resumenJugador) {
    echo "Jugador: {$resumenJugador['jugador']}\n";

    // Verificar si la clave 'partidas' existe antes de acceder
    echo "Partidas: " . (isset($resumenJugador['partidas']) ? $resumenJugador['partidas'] : 0) . "\n";

    // Verificar si la clave 'puntaje' existe antes de acceder
    echo "Puntaje Total: " . (isset($resumenJugador['puntaje']) ? $resumenJugador['puntaje'] : 0) . "\n";

    // Verificar si la clave 'victorias' existe antes de acceder
    echo "Victorias: " . (isset($resumenJugador['victorias']) ? $resumenJugador['victorias'] : 0) . "\n";

    // Calcular el porcentaje de victorias
    if (isset($resumenJugador['partidas']) && $resumenJugador['partidas'] > 0) {
        $porcentajeVictorias = ($resumenJugador['victorias'] / $resumenJugador['partidas']) * 100;
        echo "Porcentaje Victorias: {$porcentajeVictorias}%\n";
    } else {
        echo "Porcentaje Victorias: 0%\n";
    }

    // Mostrar intentos adivinados
    echo "Adivinadas:\n";
    for ($i = 1; $i <= 5; $i++) {
        $intentos = "Intento $i: ";
        if (isset($resumenJugador["intento$i"])) {
            $intentos .= $resumenJugador["intento$i"];
        } else {
            $intentos .= 'No intentado';
        }
        echo "$intentos\n";
    }
}

function compararPartidas($partida1, $partida2) {
    $comparacionPorJugador = strcmp($partida1['jugador'], $partida2['jugador']);

    if ($comparacionPorJugador !== 0) {
        return $comparacionPorJugador;
    }

    return strcmp($partida1['palabraWordix'], $partida2['palabraWordix']);
}

function mostrarPartidasOrdenadas($partidas) {
    uasort($partidas, 'compararPartidas');
    print_r($partidas);
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
    return strtolower($nombre);
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
            $llamaPalabra= ingresarPalabra();
            $partida = jugarWordix($llamaPalabra,$llamaNombreJugador );
            

            break;

        case 2: 
            $llamaNombreJugador= solicitarJugador();
            $palabraAleatoria = palabrasAleatorias();
            $partida = jugarWordix($palabraAleatoria,$llamaNombreJugador);  
            break; 
        case 3:
            $llamaSolicitarNumero=solicitarNumero($min,$llamaPartidas);
            $llama=mostrarPartida($llamaPartidas,$llamaSolicitarNumero);
            echo $llama."\n";
            break;
        case 4:
            $llamaNombreJugador= solicitarJugador();
            $indice=indicePrimeraPartidaGanada($llamaPartidas,$llamaNombreJugador);
            if ($indice !== -1) {
                $llamaPrimeraPartidaGanada=primeraPartidaGanada($llamaPartidas,$indice);
                echo $llamaPrimeraPartidaGanada;
            } else {
                echo "El jugador $nombre no ganó ninguna partida";
            }
            break;
        case 5:
            echo"ingrese el nombre del jugador\n";
            $nombre=trim(fgets(STDIN));
            $resumenJugador = obtenerResumenJugador($llamaPartidas, $nombre);

            if ($resumenJugador !== null) {
                    mostrarResumenJugador($resumenJugador);
            } else {
                    echo "No se encontró al jugador '$nombre' en la colección de partidas.\n";
            }
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

