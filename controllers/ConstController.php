<?php

require_once "core/Database.php";
require_once "core/Log.php";

class ConstController
{
    public function languages(){
        $languages = Database::select("SELECT *FROM constant_languages WHERE language_is_active = 1");

        if(!$languages->status){
            //todo
            return false;
        }

        $languages = $languages->data;

        $array = [];

        foreach ($languages as $language) {
            $array = (object)[
                "id" => $language["language_id"],
                "code" => $language["language_code"],
                "text" => $language["language_name"]
            ];
        }

        file_put_contents("constants/languages.json", json_encode($array));

        return true;
    }

    public function countries()
    {
        $languages = Database::select("SELECT *FROM constant_languages WHERE language_is_active = 1");
        $countries = Database::select("SELECT * FROM constant_countries WHERE country_is_active = 1");

        if(!$countries->status || !$languages->status){
            //todo
            return false;
        }

        $languages = $languages->data;
        $countries = $countries->data;

        foreach ($languages as $language) {
            require_once "lang/{$language["language_code"]}.php";

            $array = [];

            foreach ($countries as $country){
                $array[] = (object)[
                    "id" => $country["country_id"],
                    "text" => Lang::get("country_".$country["country_code"])
                ];
            }

            file_put_contents("constants/countries/{$language["language_code"]}.json", json_encode($array));
        }

        return true;
    }
}