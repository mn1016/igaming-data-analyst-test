<?php
@ini_set('memory_limit', '-1');
@set_time_limit(20800);

require_once '../conexion/conexion.php';
require_once '../clases/datos/datos.class.php';


function subir_archivo($tipo,$directorio){
    
    
    $con=new Conexiones();
    $con->getDatos();

    $obj=new Datos();
    
    
    $result=$obj->cargar_archivo($con,$tipo);
    
    $id_archivo=$con->db->insert_id;
    
    if($id_archivo>0){
    
        ///// Validar tipo de archivo
        $archivo=$directorio;
        $archivo=str_replace(" ", "_", $archivo);
        $archivo=strtolower($archivo);

        
        if($archivo!=''){
            
            $tipoArchivo = explode(".", $archivo);
            $tipoArchivo=$tipoArchivo[count($tipoArchivo)-1];

            if($tipo=='psp_report'&&$tipoArchivo!="json"){
                echo 'Tipo de archivo incorrecto. (JSON)';
                exit();
            }
            
            if($tipoArchivo != "csv"&&$tipo!='psp_report'){
                echo 'Tipo de archivo incorrecto. (CSV)'.$tipo;
                exit();
            }

        }else{
            echo 'No se detecto el archivo.'.PHP_EOL;
            exit();
        }



        if(!file_exists($archivo)){
            echo 'No se encontro el archivo en la ruta especificada.'.PHP_EOL;
            exit();
        }
       


        
        
        
        
        //// LEER ARCHIVO
        
        
        if($tipoArchivo=='csv'){
        
            $row = 0;
            if (($handle = fopen($archivo, "r"))!== FALSE) {
                while(($data = fgetcsv($handle,null, ",")) !== FALSE){
                    if($row>0){
                        if($tipo=='bets')$result=$obj->insertar_registro_archivo_bets($con,$id_archivo,$data);
                        if($tipo=='users')$result=$obj->insertar_registro_archivo_users($con,$id_archivo,$data);
                        if($tipo=='deposits')$result=$obj->insertar_registro_archivo_deposits($con,$id_archivo,$data);
                        if($tipo=='withdrawals')$result=$obj->insertar_registro_archivo_withdrawals($con,$id_archivo,$data);
                        
                    }
                    $row++;
                }
                fclose($handle);
            }
        
        }
        
        if($tipoArchivo=='json'&&$tipo=='psp_report'){
            $archivoJSON = file_get_contents($archivo);
            $datos = json_decode($archivoJSON, true);
            
            if($datos === null) {
                echo "Error al decodificar el JSON o el archivo está vacío.";
            }else{
                foreach($datos as $data){
                    $result=$obj->insertar_registro_archivo_psp_report($con,$id_archivo,$data);
                }
            }
        }



        $result=$obj->actualizar_archivo($con,$id_archivo,0,$archivo); 
        
        if($result==1){
            return $id_archivo;
        }else{
            return 0;
        }
        
        
        
        
        
    }else{
        echo 'Error al registrar archivo.';
    }
    
    
        
    
}
