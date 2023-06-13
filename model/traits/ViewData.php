<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

/**
 *
 * @author maria
 */
trait ViewData {
    ## add types

    private $status = Util::NO_OPERATION;

     ## add types
     private array $restaurantes;  


     public function getRestaurantes(){
         return $this->restaurantes;
 
     }
     public function setRestaurantes(array $restaurantes):void{
         $this->restaurantes = $restaurantes;
     }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status): void {
        $this->status = $status;
    }
  

    public function getImage(?Restaurante $restaurante):string{
        if($restaurante==null)
        return  ".." . DIRECTORY_SEPARATOR . "files" . DIRECTORY_SEPARATOR . "no-picture.jpg";

        if($restaurante->getId()==1)
        return "../files/pizza.jpg";
        elseif($restaurante->getId() == 2){
            return "../files/burguer.jpg";
        }
    }


  

}
