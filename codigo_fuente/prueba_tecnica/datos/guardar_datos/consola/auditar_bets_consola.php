<?php

$error=0;
$error_texto='';

function auditar_bets($id_archivo,$con,$obj,$array_estatus,$array_metodo_pago,$array_users_id){

    global $error;
    global $error_texto;

        ?>

        <?php
        $total_errores=0;
        $result=$obj->leer_archivo_bets($con,$id_archivo); 
        $id_anterior='';
        
        while($row= mysqli_fetch_assoc($result)){
            $error=0;
            $error_texto='';
            $duplicado=0;
            $registro=array();
           
                    $registro[0]=$row['bet_id']; 
                    
                    if($id_anterior!=''&&$id_anterior==$row['bet_id']){
                        $duplicado++;
                    }
                   
                    $registro[1]=validar_user_id($array_users_id, $row['user_id']); 
                   
                    $registro[2]=convertir_decimal($row['bet_amount']);
                   
                    $registro[3]=convertir_mayusculas($row['game_type']);;
                    
                    $registro[4]=convertir_mayusculas($row['result']);
                    
                    $registro[5]=convertir_decimal($row['profit_loss']);
                    
                    $registro[6]=convertir_fecha($row['created_at']);
                    
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
            $obj->insertar_registro_archivo_bets_auditado($con,$id_archivo,$registro,$error,$duplicado,$error_texto);
            
            $id_anterior=$row['bet_id'];
            
        }
        

        
        
    $result=$obj->borrar_archivo_anterior($con,$id_archivo);
    
    $result=$obj->actualizar_archivo_estatus($con,$id_archivo,1);
      
    
    
    $result=$obj->ver_auditoria_bets($con,$id_archivo);
    $datos=array();
    while($row= mysqli_fetch_assoc($result)){
        array_push($datos, $row);
    }
    
    
    $n=crear_csv($datos,'bets');
    
    echo PHP_EOL."ARCHIVO PROCESADO CON ÉXITO.".PHP_EOL;
    
    echo 'Directorio: '.$n.PHP_EOL;
    
    return $n;
    
}
