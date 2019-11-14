<?php


class Database
{
    public $db;

    public function __construct()
    {
        //todo
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=test", "root", "123456");
        } catch (PDOException $e) {
            //todo
            echo 'Connection error';
            die();
        }
    }

    public function select($query)
    {
        //todo
    }

    public function first($query)
    {
        //todo
    }

    public function exec($query)
    {
        //todo
    }

    public function insert($query)
    {
        //todo
    }

    public function isIsset($query){
        $response = $this->db->query($query, PDO::FETCH_ASSOC);

        if($response->rowCount() == 0){
            return new Output(false);
        }

        return new Output(true);
    }
}

$database = new Database();