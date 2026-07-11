<?php

if(!isset($argv[1])){
    echo 'ERROR - Falta el nombre de funcion. [ php test.php funcion valor ] '.PHP_EOL;
    
    echo PHP_EOL;
    echo 'FUNCIONES: '.PHP_EOL;
    echo 'fecha_iso : Convierte el formato a fecha ISO (AAAA-MM-DDTHH:MM:SS). '.PHP_EOL;
    echo 'decimal: Convierte el valor den decimal. '.PHP_EOL;
    echo 'payment_method: Valida que el método de pago este en el catálogo. '.PHP_EOL;
    echo 'status: Valida que el status este en el catálogo. '.PHP_EOL;
    echo 'user_id: Valida que el user_id este en el catálogo. '.PHP_EOL;
    
    exit();
}
if(!isset($argv[2])){
    echo 'ERROR - Falta el valor.  [ php test.php funcion valor ] '.PHP_EOL;
    
    echo PHP_EOL;
    echo 'FUNCIONES: '.PHP_EOL;
    echo 'fecha_iso : Convierte el formato a fecha ISO (AAAA-MM-DDTHH:MM:SS). '.PHP_EOL;
    echo 'decimal: Convierte el valor den decimal. '.PHP_EOL;
    echo 'payment_method: Valida que el método de pago este en el catálogo. '.PHP_EOL;
    echo 'status: Valida que el status este en el catálogo. '.PHP_EOL;
    echo 'user_id: Valida que el user_id este en el catálogo. '.PHP_EOL;
    
    exit();
}

if($argv[1]!="fecha_iso"&&$argv[1]!="decimal"&&$argv[1]!="payment_method"&&$argv[1]!="status"&&$argv[1]!="user_id"){
    echo 'ERROR - Funcion desconocida  [ php test.php funcion valor ] '.PHP_EOL;
    
    echo PHP_EOL;
    echo 'FUNCIONES: '.PHP_EOL;
    echo 'fecha_iso : Convierte el formato a fecha ISO (AAAA-MM-DDTHH:MM:SS). '.PHP_EOL;
    echo 'decimal: Convierte el valor den decimal. '.PHP_EOL;
    echo 'payment_method: Valida que el método de pago este en el catálogo. '.PHP_EOL;
    echo 'status: Valida que el status este en el catálogo. '.PHP_EOL;
    echo 'user_id: Valida que el user_id este en el catálogo. '.PHP_EOL;
    
    exit();
}

require_once '../conexion/conexion.php';
require_once '../clases/datos/datos.class.php';
require_once './guardar_datos/consola/validaciones_consola.php';


$con=new Conexiones();
$con->getDatos();

$obj=new Datos();

$array_metodo_pago=obtener_catalogo_metodo_pago($con,$obj);
$array_estatus=obtener_catalogo_estatus($con,$obj);
$array_users_id= obtener_catalogo_users($con,$obj);


if($argv[1]=='fecha_iso')echo convertir_fecha($argv[2]);
if($argv[1]=='decimal')echo convertir_decimal($argv[2]);
if($argv[1]=='payment_method')echo validar_metodo_pago($array_metodo_pago,$argv[2]);
if($argv[1]=='status')echo validar_estatus($array_estatus,$argv[2]);
if($argv[1]=='user_id')echo validar_user_id($array_users_id,$argv[2]);


