<?php

class User extends Entity {
    
    private $id;
        
    private $pseudo;
        
    private $password;
    
    private $email;    
    
    private $role;
        
    public function id()
    {
        return $this->id;    
    }
    
    public function pseudo()
    {
        return $this->pseudo;
    }    
        
    public function password()
    {
        return $this->password;
    }
        
    public function email()
    {
        return $this->email;
    }
    
    public function role()
    {
        return $this->role;
    }
    
    public function setId()
    {
        $id = (int) $id;
        
            if ($id > 0)
            {
                $this->_id = $id;
            }
    }
    
    public function setPseudo()
    {
        if (is_string($pseudo))
        {
            $this->pseudo = $pseudo;
        }
    }
    
    public function setPassword()
    {
        if (is_string($password))
        {
            $this->password = $password;
        }
    }
    
    public function setEmail()
    {
        if (is_string($email))
        {
            $this->email = $email;
        }
    }
    
    public function setRole()
    {
        if (is_string($role))
        {
            $this->role = $role;
        }
    }
    
    public function isAdmin()
    {       
        if($this->role == 'admin')
        {
            return true;
        } else{
            return false;
        }
    }
}