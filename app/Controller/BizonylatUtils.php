<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Vic
 * Date: 2013.11.10.
 * Time: 21:00
 * To change this template use File | Settings | File Templates.
 */

define("HYPHEN", '-');

class BizonylatUtils {
    public static function parseId($string){
        return preg_split('/\[*\]/', $string);
    }

    public static function genBizonylatSzam($date, $kiBe, $sorszam){
        return BizonylatUtils::formatKiBe($kiBe) . HYPHEN . date('Y',$date) . HYPHEN . str_pad($sorszam, 5, '0', STR_PAD_LEFT);
    }

    private static function formatKiBe($kiBe){
        return $kiBe == 1 ? 'K' : 'B';
    }
}