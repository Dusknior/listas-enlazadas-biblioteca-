<?php
include("NodoLibro.php");
include("NodoEditorial.php");

    Class Metodos
    {
        private $PTR;
        private $Final;
        
        function __construct()
        {
            $this->PTR = NULL;
            $this->Final = NULL;
        }

        function namesLibrosAnosPares(){
            $P = $this->PTR;
            $libros="";
            while ($P != NULL){
                $Q = $P->getAbajo();
                if ($P->getAbajo()!=NULL) {
                     while ($Q != NULL) {
                        if ($Q->getAno()%2==0) {
                            $libros .= "<br>" . $Q->getTitulo();
                        }
                        $Q = $Q->getAbajoL();
                    }
                 }
                $P = $P->getSig();
            }
            return $libros; 
        }

        function cantidadLibros(){
            $P = $this->PTR;
            $i=0;
            $res=0;
            while ($P != NULL){
                $Q = $P->getAbajo();
                if ($P->getAbajo()!=NULL) {
                     while ($Q != NULL) {
                        $res += $Q->getCant(); 
                         $i++;
                         $Q = $Q->getAbajoL();
                    }
                 }
                $P = $P->getSig();
            }
            return $res; 
        }

        function cantidadLibrosAno($A){
            $P = $this->PTR;
            $i=0;
            $res=0;
            while ($P != NULL){
                $Q = $P->getAbajo();
                if ($P->getAbajo()!=NULL) {
                     while ($Q != NULL) {
                        if ($Q->getAno()==$A) {
                            $res += $Q->getCant(); 
                            $i++;
                        }                        
                        $Q = $Q->getAbajoL();
                    }
                 }
                $P = $P->getSig();
            }
            return $res; 
        }

        function cantidadLibrosEditorial($E){
            $P = $this->PTR;
            $i=0;
            $res=0;
            while ($P != NULL){
                $Q = $P->getAbajo();
                if ($P->getAbajo()!=NULL) {
                    if ($P->getId()==$E) {
                        while ($Q != NULL) {
                            $res += $Q->getCant();
                            $i++;
                            $Q = $Q->getAbajoL();
                        }
                    }
                }                     
                $P = $P->getSig();
            }
            return $res; 
        }

        function getEditoriales(){
            $P = $this->PTR;

            while ($P != NULL){
                $res[] = [
                    "id" => $P->getId(),
                    "name" => $P->getname()
                ];
                $P = $P->getSig();
            }
            return $res;
        }

        function AgregarEditorial($P){

            if ($this->PTR == NULL){
                $this->PTR = $P;
            }else{
                $this->Final->setSig($P);
                $P->setAnt($this->Final);
            }
            $this->Final = $P;

        }

        function AgregarLibro($nodo_libro, $nodo_editorial){
            $P = $nodo_editorial;
            $Q = $nodo_libro;
            if ($this->EditorialVacia($P)){
               $P->setAbajo($Q);
               
            }else{
                $FinLibro = $this->ApuntarFinalEditorial($P);
                $FinLibro->setAbajoL($Q);             
            }
            return $Q;
        }

        function EditorialVacia($I){
            if ($I->getAbajo()==NULL) {
                return TRUE;
            }else{
                return FALSE;
            }

        }

        function BuscarEditorial($C){
            $P = $this->PTR;
            $Encontrado = FALSE;
            while ($P != NULL && !$Encontrado){
                if ($P->getId() == $C){
                    $Encontrado = TRUE;
                }else{
                    $P = $P->getSig();
                }
            }
            return $P;
        }

        
        function getLibros(){
            $P = $this->PTR;
            $i=0;
            while ($P != NULL){
                $Q = $P->getAbajo();
                $editorial = $P->getname();
                if ($P->getAbajo()!=NULL) {
                     while ($Q != NULL) {
                        $res[$i]= "<br><br><b style='display:block'>$editorial</b>".$this->Detallelibro($P->getId(),$Q->getIdL());
                         $i++;
                         $Q = $Q->getAbajoL();
                    }
                 }
                $P = $P->getSig();
            }
            return $res;
        }
        
        function VaciarEjemplares($idE){
            $P = $this->BuscarEditorial($idE);
            if ($P==NULL) {
                return FALSE;
            }else{
                $Q = $P->getAbajo();
                     while ($Q != NULL) {
                        $Q->setCant(0);
                        $Q = $Q->getAbajoL();
                    }
                    return TRUE;
            }
            
        }

        function ApuntarFinalEditorial($P){

            $R = $P->getAbajo();
            $s;
            while ($R->getAbajoL()!=NULL) {
               $R = $R->getAbajoL();
            }
            return $R;
        }
        
        function moverLibro($IdE,$IdL,$IdEf){
            
            $Q = $this->BuscarLibro($IdL,$IdE);
            $P = $this->BuscarEditorial($IdEf);
            $this->AgregarLibro($Q,$P);
            $this->EliminarLibro($IdE,$IdL);
        }

        function BuscarLibro($IdL, $IdE){

            $Ne = $this->BuscarEditorial($IdE);
            if ($Ne == NULL) {
                 return NULL;    
            }else{
             $R = $Ne->getAbajo();
              $Encontrado = FALSE;
            while ($R != NULL && !$Encontrado) {
                   if ($R->getIdL()==$IdL) {
                       $Encontrado=TRUE;
                   }else{
                     $R = $R->getAbajoL();
                   }
               }
             return $R; 
            
             }   
        }

        function DetalleEditorial($IdE){
             $mensaje="";
             $NL=$this->BuscarEditorial($IdE);
             if ($NL==NULL) {
                 $mensaje="Editorial no Encontrada";
             }
             else{
                 $mensaje=  "<br><b>Id Editoral: </b>".$NL->getId();
                 $mensaje.= "<br><b>name: </b> ".$NL->getname();
             }
             return $mensaje;
         }

         function Detallelibro($IdE, $IdL){
             $mensaje="";
             $NL=$this->BuscarLibro($IdL, $IdE);
             if ($NL==NULL) {
                 $mensaje="Libro no Encontrado";
             }
             else{
                 $mensaje=  "<br><b>Id libro: </b>".$NL->getIdL();
                 $mensaje.= "<br><b>Titulo: </b> ".$NL->getTitulo();
                 $mensaje.= "<br><b>Autor: </b>".$NL->getAutor();
                 $mensaje.= "<br><b>Pais: </b>".$NL->getPais();
                 $mensaje.= "<br><b>Ano: </b>".$NL->getAno();
                 $mensaje.= "<br><b>Cantidad: </b>".$NL->getCant()."<br>";

             }
             return $mensaje;
         }


        function ActualizarInventarioL($IdL, $IdE,$Ca){
             $NL = $this->BuscarLibro($IdL, $IdE);

             if ($NL == NULL) {
                 return FALSE;
             }else{
                 $NL->setCant($NL->getCant() + $Ca);
                 return true;
             }
         }

         function EliminarEditorial($idE){

             $P = $this->BuscarEditorial($idE);

             if ($P == NULL) {
                 return FALSE;
             }else{
                 if (!$this->EditorialVacia($P)) {
                     return FALSE;
                 }else{
                     if ($P == $this->PTR) {
                         if ($P->getSig() == NULL) {
                             $this->PTR = NULL;
                             $this->Final = NULL;
                         }else{
                             $this->PTR = $this->PTR->getSig();
                             $this->PTR->setAnt(null);
                         }
                     }else{
                         $P->getAnt()->setSig($P->getSig());
                         if ($P == $this->Final) {
                             $this->Final = $P->getAnt();
                         }else{
                             $P->getSig()->setAnt($P->getAnt());
                         }
                     }
                     $P = NULL;
                     return true;
                 }
             }

         }

         function EliminarLibro($idE, $idL){

             $P = $this->BuscarEditorial($idE);

             if ($P == NULL) {
                 return FALSE;
             }else{
                $Q=$P->getAbajo();
                $Ant=$Q;
                $Encontrado=FALSE;

                while ($Q!=NULL && (!$Encontrado)) {
                    if ($Q->getIdL()==$idL) {
                        $Encontrado=TRUE;
                    }else{
                        $Ant=$Q;
                        $Q = $Q->getAbajoL();
                    }
                }

             }if ($Q==NULL){
                 return FALSE;
             }else{
                if ($Q==$P->getAbajo()) {
                    $P->setAbajo($Q->getAbajoL());
                }else{
                    $Ant->setAbajoL($Q->getAbajoL());
                }
                $Q = NULL;
                return TRUE;
             }

        }


    }
    
?>