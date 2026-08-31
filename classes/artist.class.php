<?php
class Artist{
    private $m_name;


    public function __construct($p_name){
        $this->setName($p_name);

    }

    public function getName(){
        return $this->m_name;
    }
    public function setName($p_name){
        $this->m_name = $p_name;
    }
}
