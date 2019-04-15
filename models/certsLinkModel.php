<?php

class certsLinkModel extends superModel {
    
    ///// Метод получения сертификата
    public function getAll(){
        
       $id_cert =  mysql_real_escape_string($_GET['cert_id']);
        
       $result = $this->db->query ("
        
        SELECT cert_name, file_name, image_file_name, cert.active_from, cert.active_to, GROUP_CONCAT(DISTINCT users.user_name SEPARATOR ', ') as user_name, GROUP_CONCAT(DISTINCT systems.system_name SEPARATOR ', ') AS system_name, owner.user_name as owner_name

        FROM cert

        LEFT JOIN user_link_cert ON cert.cert_id = user_link_cert.cert_id

        LEFT JOIN users ON users.user_id = user_link_cert.user_id

        LEFT JOIN systems_link_cert ON cert.cert_id = systems_link_cert.cert_id

        LEFT JOIN systems ON systems.system_id = systems_link_cert.system_id

        Left JOIN (SELECT user_id, user_name FROM users) as owner ON cert.owner_id = owner.user_id

        WHERE cert.cert_id = '$id_cert'");
        return $result;
        
    }
    ///// Метод получения всех пользователей 
    public function getAllUsers(){
        
        
        $result = $this->db->query ("
        
        select user_id, user_name from users 
        where active_from <= CURRENT_DATE and active_to > CURRENT_DATE and users.status = 0
        
        ");
        
        return $result;
        
    }
    ///// Метод получения всех систем 
    public function getAllSystems(){
        
        
        $result = $this->db->query ("
        
        select system_id, system_name from systems 
        where active_from <= CURRENT_DATE and active_to > CURRENT_DATE and systems.status = 0
        
        ");
        
        return $result;
        
    }
   
    //// Метод для подключения пользователей
    public function addNewUsers($userName) {
     
        $id_cert =  mysql_real_escape_string($_GET['cert_id']);
        
        if ($id_cert !=''&&$userName!=''){
       
        $this->db->execute("     
        
        insert into user_link_cert (user_id, cert_id, active_from)
        values ('$userName','$id_cert', CURDATE())

        ");
  }
 else {
    return;    
    }
        
                 
    }
    //// Метод для подключения систем
    public function addNewSystems($systemName) {
     
        $id_cert =  mysql_real_escape_string($_GET['cert_id']);
        
        if ($id_cert !=''&&$systemName!=''){
       
        $this->db->execute("     
        
        insert into systems_link_cert (system_id, cert_id, active_from)
        values ('$systemName','$id_cert', CURDATE())

        ");
  }
 else {
    return;    
    }
        
                 
    }
    
}

