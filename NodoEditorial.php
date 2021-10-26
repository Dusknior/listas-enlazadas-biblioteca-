<?php
    
    Class Nodo_editorial
    {
        private $Id;
        private $name;
        private $Sig;
        private $Ant;
        private $Abajo;


        function __construct($Id, $name)
        {
            $this->Id = $Id;
            $this->name = $name;
            $this->Ant=NULL;
            $this->Sig=NULL;
            $this->Abajo=NULL;

        }

        function getId(){
            return $this->Id;
        }

        function getname(){
            return $this->name;
        }

        function getSig(){
            return $this->Sig;
        }

        function getAnt(){
            return $this->Ant;
        }
        function getAbajo(){
            return $this->Abajo;
        }

        function setSig($I){
            $this->Sig = $I;
        }

        function setAnt($I){
            $this->Ant = $I;
        }

        function setAbajo($I){
            $this->Abajo = $I;
        }

        function setId($I){
            $this->Id = $I;
        }

        function setname($I){
            $this->name = $I;
        }



    }
    
?>