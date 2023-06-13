<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPInterface.php to edit this template
 */

 


/**
 *
 * @author mfernandez
 */
interface IReservaRepository {

    //Recupera del JSON todas las reservas
    public function getReservas(): array;  


    public function create(Reserva $reserva): Reserva;
    public function getReservaByTel(string $tel):?Reserva;

    public function update(Reserva $reserva):bool;



}
