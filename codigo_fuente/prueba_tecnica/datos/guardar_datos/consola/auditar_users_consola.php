<?php

$error=0;
$error_texto='';

function auditar_users($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id){
    
    global $error;
    global $error_texto;
    
        
        $result=$obj->leer_archivo_users($con,$id_archivo); 
        $id_anterior='';
        $total_errores=0;
        while($row= mysqli_fetch_assoc($result)){
            $error=0;
            $error_texto='';
            $duplicado=0;
            $registro=array();
            
                    $registro[0]=$row['user_id'];
                    if($id_anterior!=''&&$id_anterior==$row['user_id']){
                        $duplicado++;
                    }
                    
                    
                    $registro[1]=$row['name'];
                    
                    
                    $registro[2]=$row['email'];
                    
                    $registro[3]=convertir_fecha($row['registered_at']); 
                    
                    $registro[4]=quitar_acentos(convertir_mayusculas($row['country']));
                    
                    $registro[5]=quitar_acentos(convertir_mayusculas($row['state']));
                    
                    $registro[6]=validar_estatus_users($row['status']);
                    
                    if($error>0){ 
                    }elseif($duplicado>0){
                        $error_texto.='ID del registro duplicado. ';
                    }else{
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
            $obj->insertar_registro_archivo_users_auditado($con,$id_archivo,$registro,$error,$duplicado,$error_texto);
            
            
            $id_anterior=$row['user_id'];
            
        }
        
        
       
        
        $result=$obj->borrar_archivo_anterior($con,$id_archivo);
        $result=$obj->actualizar_archivo_estatus($con,$id_archivo,1);
    
    
          
    $result=$obj->ver_auditoria_users($con,$id_archivo);
    $datos=array();
    while($row= mysqli_fetch_assoc($result)){
        array_push($datos, $row);
    }
    
    
    $n=crear_csv($datos,'users');
    
    echo PHP_EOL."ARCHIVO PROCESADO CON ÉXITO.".PHP_EOL;
    
    echo 'Directorio: '.$n.PHP_EOL;
    
    return $n;
    
    
    
}
