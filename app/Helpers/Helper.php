<?php

namespace App\Helpers;

class Helper
{

    public const QTDE_ITEM_POR_PAGINA = 15;
    public const REGEX_MONEY_2_DIGITS = 'regex:/^(\d{1,3}(\.\d{3})*|\d+)(\,\d{2})?$/';

    public static function valToBR($value)
    {
        return number_format($value, 2, ',', '.');
    }

    public static function valToUS($value)
    {
        return number_format(str_replace(",", ".", str_replace(".", "", $value)), 2, '.', '');
    }

    public static function formatDateBr($value)
    {
        return implode("/", array_reverse( explode("-", $value) ) );
    }

    public static function formatDateUs($value)
    {
        return implode("-", array_reverse( explode("/", $value) ) );
    }

    public static function dataValida($data)
    {

        $array = explode('/', $data);

        if(count($array) == 3){

            $dia = (int)$array[0];
            $mes = (int)$array[1];
            $ano = (int)$array[2];

            //testa se a data é válida
            if( checkdate($mes, $dia, $ano) ) {
                return true;
            }

            return false;

        }

        return false;

    }

}
