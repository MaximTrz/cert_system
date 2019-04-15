<?php


abstract class superController {
    
    private $_view;


    function __construct($view) {
      
        $this->_view = $view;
       
    }
    
    public function getInput(){
        
        
    }

    public function displayView()  
    {
    
    require ('/views/'.$this->_view);   
        
    }
    
    public function formatText($name) {
        
    $space = mb_strpos($name,' ');
    $space = (int)$space;
    $id = substr($name, 0,"$space - 1");
    return $id;
        
    }
 
     
}
