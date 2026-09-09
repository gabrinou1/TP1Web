<?php
class Artist
{
    private $m_name;
    private $m_city;
    private $m_picture;


    public function __construct($p_name, $p_city, $p_picture)
    {
        $this->setName($p_name);
        $this->setCity($p_city);
        $this->setPicture($p_picture);
    }

    public function getName()
    {
        return $this->m_name;
    }
    public function setName($p_name)
    {
        $this->m_name = $p_name;
    }

    public function getCity()
    {
        return $this->m_city;
    }    
    public function setCity($p_city)
    {
        $this->m_city = $p_city;
    }

    public function getPicture(){
        return $this->m_picture;
    }
    public function setPicture($p_picture){
        $this->m_picture = $p_picture;
    }

    public function __toString(): string{
        return "{$this->m_name}.{$this->m_city}.{this->m_picture}"; 
    }
}
