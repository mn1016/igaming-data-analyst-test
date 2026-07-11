<?php



function convertir_fecha($fecha){
    global $error;
    global $error_texto;
    
    
    
    
    $f="Y-m-d";
    $formato="d/m/Y";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    
    $formato="d-m-Y";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    
    
    $formato="Y/m/d";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    
    $formato="Y-m-d";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    
    
    $f="Y-m-d\TH:i:s";
    
    $formato="d/m/Y H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    $formato="d-m-Y H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    
    $formato="Y/m/d H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    $formato="Y-m-d H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    
    
    
    $formato="Y/m/d\TH:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    $formato="d/m/Y\TH:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    
    
    $formato="d-m-Y\TH:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    $formato="Y-m-d\TH:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $fecha;
    }
    
    
    
    
    
    
    ///////// año a dos cifras
    
    $f="Y-m-d";
    
    
    $formato="d/m/y";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    $formato="y/m/d";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    $formato="d-m-y";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    $formato="y-m-d";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f).'T00:00:00';
    }
    
    $f="Y-m-d\TH:i:s";
    $formato="y-m-d H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    $formato="y/m/d H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    $formato="d-m-y H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    $formato="d/m/y H:i:s";
    $d = DateTime::createFromFormat($formato, $fecha);
    if($d && $d->format($formato) === $fecha){
        return $d->format($f);
    }
    
    
    
    
    $error++;
    if(isset($error_texto))$error_texto.="No se reconoce el formato de la fecha. ";
    return "ERROR";
    
}


function convertir_decimal($numero){
    global $error;
    global $error_texto;
    $numero= str_replace(",", "", $numero);
    $numero= str_replace("$", "", $numero);
    $numero= str_replace("MXN", "", $numero);
    $numero= str_replace(" ", "", $numero);
    $numero= str_replace("error", "0", $numero);
    
    if($numero==''||$numero=='0'){
        return 0;
    }
    if(($numero>0||$numero<0)&&$numero!='e'&&is_numeric($numero)){
        return $numero;
    }
    
    $error++;
    if(isset($error_texto))$error_texto.="Formato de número erróneo. ";
    return "ERROR";
}




function obtener_catalogo_metodo_pago($con,$obj){
    $array_metodo_pago=array();
    $result=$obj->obtener_metodo_pago($con);
    
    while($row= mysqli_fetch_assoc($result)){
        array_push($array_metodo_pago,$row);
    }
    
    return $array_metodo_pago;
}



function validar_metodo_pago($array_metodo_pago,$valor){
    global $error;
    $valor=convertir_mayusculas($valor);
    
    foreach ($array_metodo_pago as $value) {
        if($value['metodo_pago']==$valor){
            return $value['metodo_pago'];
        }
        if(str_replace($value['metodo_pago'],'',$valor)!=$valor){
            return $value['metodo_pago'];
        }
        
    }
    
    if(str_replace('TARJETA','',$valor)!=$valor){
        return 'CARD';
    }
    
    if(str_replace('BITSO','',$valor)!=$valor){
        return 'CRYPTO';
    }
    
    $error++;
    if(isset($error_texto))$error_texto.="Método de pago fuera del catálogo. ";
    return "ERROR";
    
}






function obtener_catalogo_estatus($con,$obj){
    global $error;
    global $error_texto;
    $array_estatus=array();
    $result=$obj->obtener_estatus($con);
    
    while($row= mysqli_fetch_assoc($result)){
        array_push($array_estatus,$row);
    }
    
    return $array_estatus;
}

function validar_estatus($array_estatus,$valor){
    global $error;
    global $error_texto;
    $valor=convertir_mayusculas($valor);
    
    foreach ($array_estatus as $value) {
        if($value['descripcion_estatus']==$valor){
            return $valor;
        }
    }
    if(str_replace('SUCCESS','',$valor)!=$valor){
        return 'SUCCESSFUL';
    }
    if(str_replace('PAID','',$valor)!=$valor){
        return 'SUCCESSFUL';
    }
    if(str_replace('REJECTED','',$valor)!=$valor){
        return 'FAILED';
    }
    
    
    return "UNKNOWN";
    
}



function validar_estatus_users($valor){
    global $error;
    global $error_texto;
    
    $valor=convertir_mayusculas($valor);
    
    if($valor=='active'){
        return "ACTIVE";
    }
    if($valor=='inactive'){
        return "INACTIVE";
    }
    
    
    if($valor=='INACTIVE'){
        return "INACTIVE";
    }
    if($valor=='ACTIVE'){
        return "ACTIVE";
    }
    
    
    if($valor=='inactivo'){
        return "INACTIVE";
    }
    if($valor=='activo'){
        return "ACTIVE";
    }
    
    
    if($valor=='INACTIVO'){
        return "INACTIVE";
    }
    if($valor=='ACTIVO'){
        return "ACTIVE";
    }
    
    $error++;
    if(isset($error_texto))$error_texto.="Estatus de usuario desconocido. ";
    return "ERROR";
    
}




function convertir_mayusculas($valor){
    return mb_strtoupper($valor, 'UTF-8');
}

function quitar_acentos($valor){
    return  str_replace("'",'',iconv('UTF-8', 'ASCII//TRANSLIT', $valor));
}





function obtener_catalogo_users($con,$obj){
    global $error;
    global $error_texto;
    $array_estatus=array();
    $result=$obj->obtener_users($con);
    
    while($row= mysqli_fetch_assoc($result)){
        array_push($array_estatus,$row);
    }
    
    return $array_estatus;
}

function validar_user_id($array_users_id,$id){
    global $error;
    global $error_texto;
    
    $id=convertir_mayusculas($id);
    
    foreach ($array_users_id as $value) {
        
        if($value['user_id']==$id){
            return $id;
        }
    }
   
    
    $error++;
    if(isset($error_texto))$error_texto.="USER_ID desconocido ".$id.". ";
    return "USER ID Desconocido ".$id.". ";
    
}

        
        
        