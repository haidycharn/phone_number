<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists("getCountryName")) {
    function getCountryName() {
        return array(
            'Morocco',
            'Cameroon',
            'Ethiopia',
            'Uganda',
            'Mozambique'
        );
    }
}

if (!function_exists("getCountryCode")) {
    function getCountryCode() {
        return array (
            212,
            237,
            251,
            256,
            258
        );
    }
}

if (!function_exists("codeToCountryName")) {
    function codeToCountryName($iCode) {
        $country_code = array (
            212 => 'Morocco',
            237 => 'Cameroon',
            251 => 'Ethiopia',
            256 => 'Uganda',
            258 => 'Mozambique',
        );

        return $country_code[$iCode];
    }
}

if (!function_exists("regexByRegionCode")) {
    function regexByRegionCode($iCode) {
        $reg_exp = array (
            212 => '[5-9]\d{8}',
            237 => '[2368]\d{7,8}',
            251 => '[1-59]\d{8}',
            256 => '\d{9}',
            258 => '[28]\d{7,8}',
        );

        return $reg_exp[$iCode];
    }
}

?>