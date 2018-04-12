<?php

namespace BlogPHP\Model;

class Manager {
    
    protected function dbConnect()
        {
            try{
                $db = new \PDO('mysql:host=localhost;dbname=blogphp;charset=utf8', 'root', 'root');
                return $db;
            }catch(Exception $e){
                var_dump($e->getMessage());
            }
        }
}

