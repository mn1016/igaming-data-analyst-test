<?php

$error=0;
$error_texto='';

function auditar_deposits($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id){
    
    
    global $error;
    global $error_texto;
    

        
        $result=$obj->leer_archivo_deposits($con,$id_archivo); 
        $id_anterior='';
        $total_errores=0;
        while($row= mysqli_fetch_assoc($result)){
            $error=0;
            $error_texto='';
            $duplicado=0;
            $registro=array();
           
                    $registro[0]=$row['deposit_id'];
                   
                    if($id_anterior!=''&&$id_anterior==$row['deposit_id']){
                       
                        $duplicado++;
                    }
                    
                    $registro[1]=validar_user_id($array_users_id, $row['user_id']);
                   
                    
                    $registro[2]=$row['external_transaction_id'];
                    
                    
                    $registro[3]=convertir_decimal($row['amount']);
                   
                    
                    $registro[4]=validar_metodo_pago($array_metodo_pago,convertir_mayusculas($row['payment_method']));
                   
                    
                    $registro[5]=$row['psp'];
                   
                    
                    $registro[6]=validar_estatus($array_estatus, convertir_mayusculas($row['status']));
                    
                    
                    $registro[7]=convertir_fecha($row['created_at']);
                    
                    
                    $registro[8]=convertir_fecha($row['confirmed_at']);
                   
                    
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
            $obj->insertar_registro_archivo_deposits_auditado($con,$id_archivo,$registro,$error,$duplicado,$error_texto);
            
            
            $id_anterior=$row['deposit_id'];
            
        }
        
        
   
        
    $result=$obj->borrar_archivo_anterior($con,$id_archivo);    
    $result=$obj->actualizar_archivo_estatus($con,$id_archivo,1);
    
      
    $result=$obj->ver_auditoria_deposits($con,$id_archivo);
    $datos=array();
    while($row= mysqli_fetch_assoc($result)){
        array_push($datos, $row);
    }
    
    $n=crear_csv($datos,'deposits');
    
    echo PHP_EOL."ARCHIVO PROCESADO CON ÉXITO.".PHP_EOL;
    
    echo 'Directorio: '.$n.PHP_EOL;
    
    return $n;
    
}
