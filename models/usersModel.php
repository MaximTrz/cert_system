<?php

class usersModel extends superModel {
    
    ///// Метод получения всех пользователей 
    public function getAll(){
        
        
        $result = $this->db->query ("
        
        select users.user_id, users.user_name, GROUP_CONCAT(DISTINCT cert.cert_name SEPARATOR ', ') As cert_name

        FROM users
        
       	Left JOIN user_link_cert ON user_link_cert.user_id = users.user_id

        LEFT JOIN cert on user_link_cert.cert_id = cert.cert_id

        where users.active_from <= CURRENT_DATE and users.active_to > CURRENT_DATE and users.status = 0
        
        GROUP BY users.user_id
        
        ");
        
        return $result;
        
    }
    
    //// Метод для добавления нового пользователя
    public function addNew($userName) {
        

        
        if ($userName !='')
    {$this->db->execute("     

        insert into users (user_name, active_from)
        values ('$userName', CURDATE())

        ");
       }
    else {
        return;
    }          
    }
    ///// Метод удаления пользователя 
    public function delOne(){        
    
      $id_user = mysql_real_escape_string($_GET['user_id']);
      
      $result = $this->db->execute("UPDATE users SET status=1 WHERE user_id='$id_user'");

    }
}

