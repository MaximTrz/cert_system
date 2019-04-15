<?php

class mainModel extends superModel {
    
    
    
    ///// Метод получения всех сертификатов 
    public function getAll(){
        
        
        $result = $this->db->query ("
        
        SELECT cert.cert_id, cert_name, file_name, image_file_name, cert.active_from, cert.active_to, GROUP_CONCAT(DISTINCT systems.system_name SEPARATOR ', ') AS system_name, owner.user_name as owner_name
        FROM cert
        LEFT JOIN systems_link_cert ON cert.cert_id = systems_link_cert.cert_id
        LEFT JOIN systems ON systems.system_id = systems_link_cert.system_id
        Left JOIN (SELECT user_id, user_name FROM users) as owner ON cert.owner_id = owner.user_id

        where cert.active_to > current_date and cert.status = 0

        group by cert_id
                
        ");
        return $result;
        
    }
    
    ///// Метод получения всех сертификатов 
    public function getAllOld(){
        
        
        $result = $this->db->query ("
        
        SELECT cert.cert_id, cert_name, file_name, image_file_name, cert.active_from, cert.active_to, GROUP_CONCAT(DISTINCT systems.system_name SEPARATOR ', ') AS system_name, owner.user_name as owner_name
        FROM cert
        LEFT JOIN systems_link_cert ON cert.cert_id = systems_link_cert.cert_id
        LEFT JOIN systems ON systems.system_id = systems_link_cert.system_id
        Left JOIN (SELECT user_id, user_name FROM users) as owner ON cert.owner_id = owner.user_id

        where cert.active_to <= current_date and cert.status = 0

        group by cert_name
                
        ");
        return $result;
        
    }
    ///// Метод удаления сертификата 
    public function delOne(){        
    
      $id_cert = mysql_real_escape_string($_GET['cert_id']);
      
      $result = $this->db->execute("UPDATE cert SET status=1 WHERE cert_id='$id_cert'");

    }

}