<?php


class Language
{
    public $data;

    public static function get($name, $firstParam = '', $secondParam = '', $thirdParam = '', $fourthParam = '', $fifthParam = '')
    {
        if (Config::HIDE_LANG || !isset(self::$data[$name])) {
            return '[' . $name . ']';
        }

        $returnData = self::$data[$name];

        if ($firstParam != '') {
            $returnData = str_replace('[[FIRST_PARAM]]', $firstParam, $returnData);
        }

        if ($secondParam != '') {
            $returnData = str_replace('[[SECOND_PARAM]]', $secondParam, $returnData);
        }

        if ($thirdParam != '') {
            $returnData = str_replace('[[THIRD_PARAM]]', $thirdParam, $returnData);
        }

        if ($fourthParam != '') {
            $returnData = str_replace('[[FOURTH_PARAM]]', $fourthParam, $returnData);
        }

        if ($fifthParam != '') {
            $returnData = str_replace('[[FIFTH_PARAM]]', $fifthParam, $returnData);
        }


        return $returnData;
    }
}