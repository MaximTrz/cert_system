<?php

class systemsModel extends superModel {
    
    ///// Метод получения всех систем 
    public function getAll(){
        
       
        $result = $this->db->query ("
        
        select systems.system_id, systems.system_name, GROUP_CONCAT(DISTINCT cert.cert_name SEPARATOR ', ') As cert_name, GROUP_CONCAT(DISTINCT users.user_name SEPARATOR ', ') As user_name

        FROM systems
       
        LEFT JOIN systems_link_cert ON systems.system_id = systems_link_cert.system_id

        LEFT JOIN cert ON cert.cert_id = systems_link_cert.cert_id
       
       	LEFT JOIN user_link_cert ON cert.cert_id = user_link_cert.cert_id

        LEFT JOIN users ON users.user_id = user_link_cert.user_id

        where systems.active_from <= CURRENT_DATE and systems.active_to > CURRENT_DATE and systems.status = 0
        
        GROUP BY systems.system_id
        
        ");
     
        return $result;
    
    }
    
    //// Метод для добавления новой системы
    public function addNew($systemName) {
        

        
         if ($systemName !='')
    {$this->db->execute("     

        insert into systems (system_name, active_from)
        values ('$systemName', CURDATE())

        ");
         }
    else {
        return;
    }        
    }
    ///// Метод удаления системы 
    public function delOne(){        
    
      $id_system = mysql_real_escape_string($_GET['system_id']);
      
      $result = $this->db->execute("UPDATE systems SET status=1 WHERE system_id='$id_system'");

    }
}

