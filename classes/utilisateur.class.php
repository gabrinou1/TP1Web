<?php
class User{
    private $m_name;
    private $m_password;
    private $m_email;
    private $m_role;



    public function __construct($p_name, $p_password, $p_email, $p_role){
        $this->setName($p_name);
        $this->setPassword($p_password);
        $this->setEmail($p_email);
        $this->setRole($p_role);
    }

    public function getName(){
        return $this->m_name;
    }
    public function setName($p_name){
        $this->m_name = $p_name;
    }

   

    public function getPassword(){
        return $this->m_password;
    }
    public function setPassword($p_password){
        $this->m_password = $p_password;
    }

    public function getEmail(){
        return $this->m_email;
    }
    public function setEmail($p_email){
        $this->m_email = $p_email;
    }

     public function getRole(){
        return $this->m_role;
    }
    public function setRole($p_role){
        $this->m_role = $p_role;
    }

    public function __toString(): string {
        return "{$this->m_name}" . "{$this->m_role}";
    }
}