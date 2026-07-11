<?php

function crear_csv($datos,$tipo){
    
    $nombreArchivo = $tipo.'_processed_'.(date('Ymd\THis')).'_'.rand(1000,9999).'_'.rand(1000,9999).'.csv';
    $directorio="../data/processed";
    $archivo = fopen($directorio.'/'.$nombreArchivo, 'w');

    if($archivo) {
        $i=0;
        foreach ($datos as $value) {
            if($i==0){
                $encabezado=array();
                foreach($value as $key => $titulo) {
                    $encabezado[$key]=$key;
                }
                fputcsv($archivo, $encabezado);
            }
            fputcsv($archivo, $value);
            $i++;
        }
        fclose($archivo);
        
    } else {
        echo "Error al crear el archivo CSV.";
    }
    
    
    return $directorio.'/'.$nombreArchivo;
    
}