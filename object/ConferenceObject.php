<?php


class ConferenceObject
{
    public $id, $name, $desc, $applyStart, $applyEnd, $start, $end, $country, $address, $phone, $email;

    public function __construct($id = 0)
    {
        if($id == 0){
            return;
        }


        //todo
    }

    public function insert(){
        //todo
    }

    public function update(){
        //todo
    }

    public function delete(){
        //todo
    }

    public function select(){
        //todo
    }

    public function selectForAjax(){
        //todo
    }
}