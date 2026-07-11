<?php
class Conexiones {
   
    public $db;
    public $res;
    function __construct() {
        
    }
    function conectaGen($host, $usuario, $pass, $base) {
        $this->db = new mysqli($host, $usuario, $pass, $base);
        if ($this->db->connect_error) {
            die('Imposible conectar. ');
//            die('Error de Conexión (' . $this->db->connect_errno . ') '
//                    . $this->db->connect_error);
        }
        if (!mysqli_set_charset($this->db,"utf8")) {
            printf("Error cargando el conjunto de caracteres utf8: %s\n", $this->db->error);
            exit();
        } else {
            
        }
    }
    
    function getDatos() {
        $servidor="localhost";
        $usuario="root";
        $pass="";
        $base="prueba_tecnica";
        $puerto="3306";
        $this->conectaGen($servidor, $usuario, $pass, $base, $puerto);
        return $this->db;
    }
   

    function closeCon() {
        $this->db->close();
    }
    
    function last_id() {
        $id = $this->db->insert_id;
        return $id;
    }
}
