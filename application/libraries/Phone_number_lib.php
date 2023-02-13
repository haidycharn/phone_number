<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once __DIR__.'/Phone_lib.php';

class Phone_number_lib extends Phone_lib {

    protected function get_country_code($phone_number) {
        preg_match('/\((.+\d)\)/is', $phone_number, $code);
        return (!empty($code) ? $code[1] : $this->$county_code) ;
    }

    protected function get_country_name($country_code) {
        if(checkCountryCode($country_code)) {
            $country_name = codeToCountryName($country_code);
            if(checkCountryName($country_name))
                return $country_name;
        }
        return $this->country_name;
    }

    protected function get_number_state($country_code, $phone_number) {
        preg_match('/\('.$country_code.'\)\ ?'.regexByRegionCode($country_code).'$/', $phone_number, $state);
        return (($state) ? 'OK' : 'NOK') ;
    }

    protected function get_number($country_code, $phone_number) {
        return str_replace('('.$country_code.')', '', $phone_number);
    }

    public function validate_phonenumber($phone_number)
    {
        $this->county_code = $this->get_country_code($phone_number);
        $this->country_name = $this->get_country_name($this->county_code);
        $this->state = $this->get_number_state($this->county_code, $phone_number);
        $this->number = $this->get_number($this->county_code, $phone_number);
        
        return array(
            'country_code' => $this->county_code,
            'country_name' => $this->country_name,
            'state' => $this->state,
            'phone' => $this->number
        );
    }

}

?>