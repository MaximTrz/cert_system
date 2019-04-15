<?php


class dataBase {
    
    private $db; 

    public function __construct($host, $username, $password, $dbname) {
        
        $this->db=mysql_connect($host, $username, $password) or die("Ошибка подключения к БД!");
        
        mysql_select_db($dbname, $this->db);
        mysql_query("SET NAMES `utf8`");   
        mysql_query("set character_set_client='utf8'");    
        mysql_query("set character_set_results='utf8'");    
        mysql_query("set collation_connection='utf8'");  

        
    }
    
    
    public static function execute($q){

    mysql_query($q);

    }


    public static function query($q){

    $result=mysql_query($q);

    $arr = array();

    while ($row = mysql_fetch_assoc($result))
    $arr[]=$row;

    return $arr;

    }

    
}
