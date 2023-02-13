<?php

if (!function_exists("checkCountryCode")) {
    function checkCountryCode($iCode) {
        $iCodeList = getCountryCode();
        return in_array($iCode, $iCodeList);
    }
}

if (!function_exists("checkCountryName")) {
    function checkCountryName($iName) {
        $iNameList = getCountryName();
        return in_array($iName, $iNameList);
    }
}
?>