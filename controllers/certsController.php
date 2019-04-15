<?php

class certsController extends superController {
    
    public $certName;
    public $userName;
    public $fileName;
    public $imageName;
    public $activeFrom;
    public $activeTo;
    
    public function getInput() {
        
        $this->certName= mysql_real_escape_string($_REQUEST['cert_name']);
        
        $userName= mysql_real_escape_string($_REQUEST['owner_id']);
        $this->userName = $this->formatText($userName);
        
        $this->fileName= mysql_real_escape_string($_FILES['file_name']['name']);
        $this->imageName= mysql_real_escape_string($_FILES['image_file_name']['name']);
        $this->activeFrom= date('Y-m-d', strtotime(str_replace('-', '/', ($_REQUEST['active_from']))));
        $this->activeTo= date('Y-m-d', strtotime(str_replace('-', '/', ($_REQUEST['active_to']))));
       
    }
    
   
    
}
