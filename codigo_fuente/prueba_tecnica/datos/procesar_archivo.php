<?php

if(!isset($argv[1])){
    echo 'ERROR - Falta el tipo de base. [ php procesar_archivo.php tipo_base direccion_archivo ]'.PHP_EOL;
    exit();
}
if(!isset($argv[2])){
    echo 'ERROR - Falta la dirección del archivo. [ php procesar_archivo.php tipo_base direccion_archivo ]'.PHP_EOL;
    exit();
}

if($argv[1]!="users"&&$argv[1]!="deposits"&&$argv[1]!="bets"&&$argv[1]!="psp_report"&&$argv[1]!="withdrawals"){
    echo 'ERROR - Tipo de base desconocido  [  php procesar_archivo.php tipo_base direccion_archivo ] '.PHP_EOL;
    echo 'Tipos: users, deposits, bets, psp_report, withdrawals '.PHP_EOL;
    
   
    
    exit();
}




echo "SUBIENDO ARCHIVO A LA BASE DE DATOS.".PHP_EOL;
echo "Tipo de archivo: ".$argv[1]."".PHP_EOL;
echo "Ruta: ".$argv[2]."".PHP_EOL;

require_once './guardar_datos/consola/subir_archivo_consola.php';

$id_archivo=subir_archivo($argv[1],$argv[2]);

if(!$id_archivo>0){
    echo 'ERROR al leer el archivo.'.PHP_EOL;
}

echo 'Archivo original cargado a la base de datos. ID asignado:'.$id_archivo.PHP_EOL;

echo "PROCESANDO ARCHIVO.".PHP_EOL;


require_once './guardar_datos/consola/auditar_archivo_consola.php';

auditar_archivo($id_archivo);


