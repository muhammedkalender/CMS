<?php


//todo komple elden geçecek
$db = null;

try {
    $db = new PDO("mysql:host=localhost:3307;dbname=cms;charset=utf8mb4", "root", "");
} catch (PDOException $e) {
    echo 'Connection error';
    die();
}

class Database
{
    public function select($query)
    {
        try {
            global $db;
            return new Output(true, '', $db->prepare($query)->execute()->fetchAll(PDO::FETCH_ASSOC));
        } catch (Exception $e) {
            return new Output(false, $e->getMessage());
        }
    }

    public static function first($query)
    {
        try {
            global $db;
            return new Output(true, '', $db->prepare($query.' LIMIT 1')->execute()->fetchAll(PDO::FETCH_ASSOC)[0]);
        } catch (Exception $e) {
            return new Output(false, $e->getMessage());
        }
    }

    public static function exec($query)
    {
        try {
            global $db;
            $db->prepare($query)->execute();
            return new Output(true);
        } catch (Exception $e) {
            return new Output(false, $e->getMessage());
        }
    }

    public static function insert($query)
    {
        try {
            global $db;
            $db->prepare($query)->execute();

            echo $query;
            return new Output(true, null, $db->lastInsertId());
        } catch (Exception $e) {
            return new Output(false, $e->getMessage(), false);
        }
    }

    public static function isIsset($query)
    {
        try{
            global $db;

            $response = $db->query($query, PDO::FETCH_ASSOC);

            $response->execute();

            if ($response->rowCount() == 0) {
                return new Output(true, '', false);
            }

            return new Output(true, '', true);
        }catch (Exception $e){
            return new Output(false, '', false);
        }
    }

    public static function insertReturnID($query)
    {
        try {
            global $db;
            if($db->prepare($query)->execute() == false){
                throw new Exception('');
            }

            return new Output(true, '', $db->lastInsertId());
        } catch (Exception $e) {
            return new Output(false, $query);
        }
    }
}

$database = new Database();