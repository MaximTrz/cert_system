<?php

class usersController extends superController {
    
    public $userName;
    
    public function getInput() {
        
        $this->userName= mysql_real_escape_string($_REQUEST['users_name']);
       
    }
    
   
    
}
