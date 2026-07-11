<?php

$error=0;
$error_texto='';

function auditar_psp_report($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id){
    
    global $error;
    global $error_texto;
    
        
        $result=$obj->leer_archivo_psp_report($con,$id_archivo); 
        $id_anterior='';
        $registro=array();
        $total_errores=0;
        while($row= mysqli_fetch_assoc($result)){
            $error=0;
            $error_texto='';
            $duplicado=0;
            $registro=array();
           
            
                    $registro[0]=str_replace('-X','',$row['transaction_id']); 
                    
                    if($id_anterior!=''&&$id_anterior==$row['transaction_id']){
                        $duplicado++;
                    }
                   
                    $registro[1]=convertir_decimal($row['amount']); 
                   
                    $registro[2]= validar_estatus($array_estatus, convertir_mayusculas($row['status'])); 
                   
                    $registro[3]= validar_metodo_pago($array_metodo_pago, convertir_mayusculas($row['payment_method']));
                    
                    $registro[4]= convertir_fecha($row['processed_at']);
                    
                    $registro[5]= $row['provider'];
                   
                    if($error>0){
                         
                    }elseif($duplicado>0){ 
                        $error_texto.='ID del registro duplicado. ';
                    }
                   
            $total_errores+=$error;
            if($error>0){
                $error=2;
            }else{
                $error=1;
                if($duplicado>0){
                    $error=2;
                }
            }
            $obj->insertar_registro_archivo_psp_report_auditado($con,$id_archivo,$registro,$error,$duplicado,$error_texto);
            
            $id_anterior=$row['transaction_id'];
            
        }
        
     
        
    $result=$obj->borrar_archivo_anterior($con,$id_archivo);    
    $result=$obj->actualizar_archivo_estatus($con,$id_archivo,1);
    
       
    $result=$obj->ver_auditoria_psp_report($con,$id_archivo);
    $datos=array();
    while($row= mysqli_fetch_assoc($result)){
        array_push($datos, $row);
    }
    
    $n=crear_csv($datos,'psp_report');
    
    echo PHP_EOL."ARCHIVO PROCESADO CON ÉXITO.".PHP_EOL;
    
    echo 'Directorio: '.$n.PHP_EOL;
    
    return $n;
    
}
