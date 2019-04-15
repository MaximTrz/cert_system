<?php

class certsModel extends superModel {
    ///// Метод получения всех систем
    public function getAll(){
       
        
        $result = $this->db->query ("
        
        select user_id, user_name from users 
        where active_from <= CURRENT_DATE and active_to > CURRENT_DATE  and users.status = 0
        
        ");
     
        return $result;
        
    }
    
    //// Метод для добавления нового сертификата
    public function addNew($certName,$userName,$fileName,$imageName,$activeFrom,$activeTo) {
       
        $int = iconv_strlen ($imageName);
        
        if ($int<=0){
 if ($certName !=''&&$userName!=''&&$fileName!=''&&$activeFrom!=''&&$activeTo!='')
    {$this->db->execute("     

        insert into cert (cert_name,owner_id, file_name, active_from, active_to)
        values ('$certName','$userName','$fileName','$activeFrom','$activeTo')

        ");
                $id = mysql_insert_id();
                $temp=$_FILES['file_name']['tmp_name'];
                $name=$_FILES['file_name']['name'];
                $filesname = iconv("UTF-8", "windows-1251",$name);
                
                if (is_dir("UpFiles/".$id."/")){
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                else {
                   
                    mkdir("UpFiles/$id", 0777);
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                       
                } else {
                return ;
                } 
        } else {
        
        if ($certName !=''&&$userName!=''&&$fileName!=''&&$imageName!=''&&$activeFrom!=''&&$activeTo!='')
    {$this->db->execute("     

        insert into cert (cert_name,owner_id, file_name, image_file_name, active_from, active_to)
        values ('$certName','$userName','$fileName','$imageName','$activeFrom','$activeTo')

        ");
                $id = mysql_insert_id();
                $temp=$_FILES['file_name']['tmp_name'];
                $name=$_FILES['file_name']['name'];
                $filesname = iconv("UTF-8", "windows-1251",$name);
                
                if (is_dir("UpFiles/".$id."/")){
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                else {
                   
                    mkdir("UpFiles/$id", 0777);
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                
                $temp=$_FILES['image_file_name']['tmp_name'];
                $name=$_FILES['image_file_name']['name'];
                $filesname = iconv("UTF-8", "windows-1251",$name);
                
                if (is_dir("UpFiles/".$id."/")){
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                else {
                   
                    mkdir("UpFiles/$id", 0777);
                move_uploaded_file($temp,"UpFiles/".$id."/".$filesname);
                }
                
         
                } else {
                return ;
                }  
        }
    }
    
}

