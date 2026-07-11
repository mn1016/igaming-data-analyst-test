<?php
@session_start();
@$_SESSION_N=$_SESSION;
@session_write_close();
class Datos{
    function __construct() {
        
    }
    function log($con,$evento,$id_usuario,$usuario){
        $query='insert into log set evento="'.$evento.'", usuario="'.$this->limpiar_sql($usuario).'", id_usuario="'.$this->limpiar_sql($id_usuario).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
    }
    function control_cambios($con,$id_guion,$evento,$descripcion){
        
        $query='insert into amc_guion_control_cambios
                 set id_guion="'.$this->limpiar_sql($id_guion).'", 
                     evento="'.$this->limpiar_sql($evento).'", 
                     descripcion="'.$this->limpiar_sql($descripcion).'", 
                     id_usuario="'.$this->limpiar_sql($_SESSION_N['id_usuario']).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
    }
    function obtener_control_cambios($con,$id_guion){
        $query='select A.*, concat(B.nombre," ", B.apaterno) usuario from amc_guion_control_cambios A
                left join c_usuarios B on B.id_usuario=A.id_usuario 
                 where id_guion="'.$this->limpiar_sql($id_guion).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
    }
    
    
    
    
    
    
    
    function obtener_tabla_archivos($con){
        
        
        
        $query='select * from m_archivos    
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    
    
    function cargar_archivo($con,$tipo){
        
        
        
        $query='insert into m_archivos set 
                tipo="'.$this->limpiar_sql($tipo).'",
                fecha_alta=now(),
                id_usuario=1,
                estatus=3
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    
    
    function actualizar_archivo($con,$id_archivo,$estatus,$nombre_archivo){
        
        
        
        $query='update m_archivos set 
                estatus="'.$this->limpiar_sql($estatus).'",
                nombre_archivo="'.$this->limpiar_sql($nombre_archivo).'"
                    where 
                id_archivo="'.$this->limpiar_sql($id_archivo).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    
    function borrar_archivo_anterior($con,$id_archivo){
        
        
        
        $query='delete from m_archivos 
                    where 
                id_archivo!="'.$this->limpiar_sql($id_archivo).'"
                and tipo=(select A.tipo from m_archivos A where A.id_archivo="'.$this->limpiar_sql($id_archivo).'")
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }function actualizar_archivo_estatus($con,$id_archivo,$estatus){
        
        
        
        $query='update m_archivos set 
                estatus="'.$this->limpiar_sql($estatus).'"
                    where 
                id_archivo="'.$this->limpiar_sql($id_archivo).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    function insertar_registro_archivo_bets($con,$id_archivo,$data){
        
        
        
        $query='insert into m_bets_original set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                bet_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                bet_amount="'.$this->limpiar_sql($data[2]).'",
                game_type="'.$this->limpiar_sql($data[3]).'",
                result="'.$this->limpiar_sql($data[4]).'",
                profit_loss="'.$this->limpiar_sql($data[5]).'",
                created_at="'.$this->limpiar_sql($data[6]).'"
                 
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    function insertar_registro_archivo_users($con,$id_archivo,$data){
        
        
        
        $query='insert into m_users_original set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                user_id="'.$this->limpiar_sql($data[0]).'",
                name="'.$this->limpiar_sql($data[1]).'",
                email="'.$this->limpiar_sql($data[2]).'",
                registered_at="'.$this->limpiar_sql($data[3]).'",
                country="'.$this->limpiar_sql($data[4]).'",
                state="'.$this->limpiar_sql($data[5]).'",
                status="'.$this->limpiar_sql($data[6]).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    function insertar_registro_archivo_deposits($con,$id_archivo,$data){
        
        
        
        $query='insert into m_deposits_original set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                deposit_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                external_transaction_id="'.$this->limpiar_sql($data[2]).'",
                amount="'.$this->limpiar_sql($data[3]).'",
                payment_method="'.$this->limpiar_sql($data[4]).'",
                psp="'.$this->limpiar_sql($data[5]).'",
                status="'.$this->limpiar_sql($data[6]).'",
                created_at="'.$this->limpiar_sql($data[7]).'",
                confirmed_at="'.$this->limpiar_sql($data[8]).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    function insertar_registro_archivo_withdrawals($con,$id_archivo,$data){
        
        
        
        $query='insert into m_withdrawals_original set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                withdrawal_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                amount="'.$this->limpiar_sql($data[2]).'",
                method="'.$this->limpiar_sql($data[3]).'",
                status="'.$this->limpiar_sql($data[4]).'",
                created_at="'.$this->limpiar_sql($data[5]).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    function insertar_registro_archivo_psp_report($con,$id_archivo,$data){
        
        
        
        $query='insert into m_psp_report_original set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                transaction_id="'.$this->limpiar_sql($data['transaction_id']).'",
                amount="'.$this->limpiar_sql($data['amount']).'",
                status="'.$this->limpiar_sql($data['status']).'",
                payment_method="'.$this->limpiar_sql($data['payment_method']).'",
                processed_at="'.$this->limpiar_sql($data['processed_at']).'",
                provider="'.$this->limpiar_sql($data['provider']).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    
    
    function leer_archivo($con,$id_archivo){
        
        
        $query='select * from m_archivos where id_archivo="'.$this->limpiar_sql($id_archivo).'"   
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
    }
    
    
    
    
    
    
    
    
    
    
    function leer_archivo_bets($con,$id_archivo){
        
        
        $query='select * from m_bets_original where id_archivo="'.$this->limpiar_sql($id_archivo).'"   order by bet_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function leer_archivo_users($con,$id_archivo){
        
        
        $query='select * from m_users_original where id_archivo="'.$this->limpiar_sql($id_archivo).'"   order by user_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function leer_archivo_deposits($con,$id_archivo){
        
        
        $query='select * from m_deposits_original where id_archivo="'.$this->limpiar_sql($id_archivo).'"  order by  deposit_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function leer_archivo_withdrawals($con,$id_archivo){
        
        
        $query='select * from m_withdrawals_original where id_archivo="'.$this->limpiar_sql($id_archivo).'" order by  withdrawal_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function leer_archivo_psp_report($con,$id_archivo){
        
        
        $query='select * from m_psp_report_original where id_archivo="'.$this->limpiar_sql($id_archivo).'"  order by transaction_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function ver_auditoria_bets($con,$id_archivo){
        
        
        $query='select * from m_bets_auditado where id_archivo="'.$this->limpiar_sql($id_archivo).'"   order by bet_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function ver_auditoria_users($con,$id_archivo){
        
        
        $query='select * from m_users_auditado where id_archivo="'.$this->limpiar_sql($id_archivo).'"   order by user_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function ver_auditoria_deposits($con,$id_archivo){
        
        
        $query='select * from m_deposits_auditado where id_archivo="'.$this->limpiar_sql($id_archivo).'"  order by  deposit_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function ver_auditoria_withdrawals($con,$id_archivo){
        
        
        $query='select * from m_withdrawals_auditado where id_archivo="'.$this->limpiar_sql($id_archivo).'" order by  withdrawal_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    function ver_auditoria_psp_report($con,$id_archivo){
        
        
        $query='select * from m_psp_report_auditado where id_archivo="'.$this->limpiar_sql($id_archivo).'"  order by transaction_id
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        } 
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function obtener_metodo_pago($con){
        
        
        $query='select * from c_metodo_pago where estatus=1   
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
    }
    
    
    function obtener_estatus($con){
        
        
        $query='select * from c_estatus where estatus=1   
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
    }
    
    function obtener_users($con){
        
        
        $query='select * from c_users where estatus>0   
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
    }
    
     
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function insertar_registro_archivo_bets_auditado($con,$id_archivo,$data,$estatus,$duplicado,$resultado_auditoria){
        
        
        
        $query='insert into m_bets_auditado set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                bet_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                bet_amount="'.$this->limpiar_sql($data[2]).'",
                game_type="'.$this->limpiar_sql($data[3]).'",
                result="'.$this->limpiar_sql($data[4]).'",
                profit_loss="'.$this->limpiar_sql($data[5]).'",
                created_at="'.$this->limpiar_sql($data[6]).'",
                estatus="'.$this->limpiar_sql($estatus).'",
                duplicado="'.$this->limpiar_sql($duplicado).'",
                resultado_auditoria="'.$this->limpiar_sql($resultado_auditoria).'"
                 
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    function insertar_registro_archivo_users_auditado($con,$id_archivo,$data,$estatus,$duplicado,$resultado_auditoria){
        
        
        
        $query='insert into m_users_auditado set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                user_id="'.$this->limpiar_sql($data[0]).'",
                name="'.$this->limpiar_sql($data[1]).'",
                email="'.$this->limpiar_sql($data[2]).'",
                registered_at="'.$this->limpiar_sql($data[3]).'",
                country="'.$this->limpiar_sql($data[4]).'",
                state="'.$this->limpiar_sql($data[5]).'",
                status="'.$this->limpiar_sql($data[6]).'",
                estatus="'.$this->limpiar_sql($estatus).'",
                duplicado="'.$this->limpiar_sql($duplicado).'",
                resultado_auditoria="'.$this->limpiar_sql($resultado_auditoria).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    
    
    function insertar_registro_archivo_deposits_auditado($con,$id_archivo,$data,$estatus,$duplicado,$resultado_auditoria){
        
        
        
        $query='insert into m_deposits_auditado set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                deposit_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                external_transaction_id="'.$this->limpiar_sql($data[2]).'",
                amount="'.$this->limpiar_sql($data[3]).'",
                payment_method="'.$this->limpiar_sql($data[4]).'",
                psp="'.$this->limpiar_sql($data[5]).'",
                status="'.$this->limpiar_sql($data[6]).'",
                created_at="'.$this->limpiar_sql($data[7]).'",
                confirmed_at="'.$this->limpiar_sql($data[8]).'",
                estatus="'.$this->limpiar_sql($estatus).'",
                duplicado="'.$this->limpiar_sql($duplicado).'",
                resultado_auditoria="'.$this->limpiar_sql($resultado_auditoria).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    function insertar_registro_archivo_withdrawals_auditado($con,$id_archivo,$data,$estatus,$duplicado,$resultado_auditoria){
        
        
        
        $query='insert into m_withdrawals_auditado set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                withdrawal_id="'.$this->limpiar_sql($data[0]).'",
                user_id="'.$this->limpiar_sql($data[1]).'",
                amount="'.$this->limpiar_sql($data[2]).'",
                method="'.$this->limpiar_sql($data[3]).'",
                status="'.$this->limpiar_sql($data[4]).'",
                created_at="'.$this->limpiar_sql($data[5]).'",
                estatus="'.$this->limpiar_sql($estatus).'",
                duplicado="'.$this->limpiar_sql($duplicado).'",
                resultado_auditoria="'.$this->limpiar_sql($resultado_auditoria).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }
    function insertar_registro_archivo_psp_report_auditado($con,$id_archivo,$data,$estatus,$duplicado,$resultado_auditoria){
        
        
        
        $query='insert into m_psp_report_auditado set 
                id_archivo="'.$this->limpiar_sql($id_archivo).'",
                transaction_id="'.$this->limpiar_sql($data[0]).'",
                amount="'.$this->limpiar_sql($data[1]).'",
                status="'.$this->limpiar_sql($data[2]).'",
                payment_method="'.$this->limpiar_sql($data[3]).'",
                processed_at="'.$this->limpiar_sql($data[4]).'",
                provider="'.$this->limpiar_sql($data[5]).'",
                estatus="'.$this->limpiar_sql($estatus).'",
                duplicado="'.$this->limpiar_sql($duplicado).'",
                resultado_auditoria="'.$this->limpiar_sql($resultado_auditoria).'"
                ';
        //echo $query;
        $result=$con->db->query($query);
        if(mysqli_errno($con->db)!='0'){
            return 0;
        }else{
            return $result;
        }
        
        
        
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function limpiar_sql($valor){
        $valor= str_ireplace('select ','',$valor);
        $valor= str_ireplace('insert into ','',$valor);
        $valor= str_ireplace('replace into ','',$valor);
        $valor= str_ireplace('update ','-update- ',$valor);
        $valor= str_ireplace('delete from ','',$valor);
        $valor= str_ireplace(' and ',' -and- ',$valor);
        $valor= str_ireplace(' or ',' -or- ',$valor);
        $valor= addslashes($valor);
        $valor=filter_var($valor,FILTER_SANITIZE_STRING);
        return $valor;
    }
    
    
    
    
    
}