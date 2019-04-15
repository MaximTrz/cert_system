<?php

class certsLinkController extends superController {
    
    
    public $userName;
    public $systemName;
    

    public function getInput() {
        
         $systemName= mysql_real_escape_string($_REQUEST['system_name']);       
        $this->systemName = $this->formatText($systemName);
        
        $userName= mysql_real_escape_string($_REQUEST['owner_id']);
        $this->userName = $userName;
        
             
    }
    
   
    
}
