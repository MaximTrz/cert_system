<?php

class superModel {

    protected $db;
    
    function __construct($db) {
        $this->db=$db;
    }
    
    ///// Метод получения всех пользователей (реализация будет определена в дочернем классе)
    public function getAll() {
        
    }
    
    
    //// Метод для добавления нового пользователя (реализация будет определена в дочернем классе)
    public function addNew() {
        
    }
    

   
}
