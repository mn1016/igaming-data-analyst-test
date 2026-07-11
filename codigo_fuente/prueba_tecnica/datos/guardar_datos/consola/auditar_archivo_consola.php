<?php

@ini_set('memory_limit', '-1');
@set_time_limit(20800);



require_once '../conexion/conexion.php';
require_once '../clases/datos/datos.class.php';
require_once './guardar_datos/consola/validaciones_consola.php';
require_once './guardar_datos/consola/crear_csv_consola.php';



function auditar_archivo($id_archivo){
    
    
    $con=new Conexiones();
    $con->getDatos();

    $obj=new Datos();
    
    $result=$obj->leer_archivo($con,$id_archivo); 
    
    if($row_archivo= mysqli_fetch_assoc($result)){
        
    }else{
        echo 'No se encontro el archivo.'.PHP_EOL;
        exit();
    }
    
    $array_metodo_pago=obtener_catalogo_metodo_pago($con,$obj);
    $array_estatus=obtener_catalogo_estatus($con,$obj);
    $array_users_id= obtener_catalogo_users($con,$obj);
    
    
    
    
    if($row_archivo['tipo']=='bets'){
        require_once './guardar_datos/consola/auditar_bets_consola.php';
        auditar_bets($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id);
    }
    
    if($row_archivo['tipo']=='users'){
        require_once './guardar_datos/consola/auditar_users_consola.php';
        auditar_users($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id);
    }
    
    if($row_archivo['tipo']=='deposits'){
        require_once './guardar_datos/consola/auditar_deposits_consola.php';
        auditar_deposits($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id);
    }
    
    if($row_archivo['tipo']=='withdrawals'){
        require_once './guardar_datos/consola/auditar_withdrawals_consola.php';
        auditar_withdrawals($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id);
    }
    
    if($row_archivo['tipo']=='psp_report'){
        require_once './guardar_datos/consola/auditar_psp_report_consola.php';
        auditar_psp_report($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id);
    }
    
        
    
}
