<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class Phone_lib {

    protected $CI;
    protected $county_code = '';
    protected $country_name = '';
    protected $state = 'NOK';
    protected $number = '';

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    }

    abstract protected function get_country_code($phone_number);

    abstract protected function get_country_name($country_code);

    abstract protected function get_number_state($country_code, $phone_number);

    abstract protected function get_number($country_code, $phone_number);

    abstract protected function validate_phonenumber($phone_number);

}
?>