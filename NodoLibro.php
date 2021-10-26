<?php
    
    // Definicion de la clase tipo NODO
    Class Nodo_libro
    {
        private $AbajoL;
        private $IdL;
        private $Titulo;
        private $Autor;
        private $Pais;
        private $Ano;
        private $Cant;

        function __construct($IdL = null, $Titulo = null, $Autor = null, $Pais = null,$Ano = null, $Cant = null)
        {
            $this->IdL = $IdL;
            $this->Titulo = $Titulo;
            $this->Autor = $Autor;
            $this->Pais = $Pais;
            $this->Ano = $Ano;
            $this->Cant = $Cant;
            $this->AbajoL= NULL;

        }

        function getIdL(){
            return $this->IdL;
        }

        function getTitulo(){
            return $this->Titulo;
        }

        function getAutor(){
            return $this->Autor;
        }

        function getPais(){
            return $this->Pais;
        }

        function getAno(){
            return $this->Ano;
        }
        function getCant(){
            return $this->Cant;
        }

        function getAbajoL(){
            return $this->AbajoL;
        }

        function setIdL($I){
            $this->IdL = $I;
        }

        function setTitulo($I){
            $this->Titulo = $I;
        }

        function setAutor($I){
            $this->Autor = $I;
        }

        function setPais($I){
            $this->Pais = $I;
        }

        function setAno($I){
            $this->Ano = $I;
        }

        function setCant($I){
            $this->Cant = $I;
        }
        function setAbajoL($I){
            $this->AbajoL = $I;
        }

        
    }
    
?>