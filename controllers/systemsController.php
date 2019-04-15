<?php

class systemsController extends superController {
    
    public $systemName;
    
    public function getInput() {
        
        $this->systemName= mysql_real_escape_string($_REQUEST['systems_name']);
       
    }
    
   
    
}
