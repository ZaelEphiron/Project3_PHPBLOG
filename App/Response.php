<?php 

namespace BlogPHP\App;

class Response{
    
    public function redirect($param){
        header('Location: index.php?action='.$param);
        exit();
    }
}