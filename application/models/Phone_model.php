<?php
class Phone_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function getCustomers()
    {
        return $this->db->get('customer')->result_array();
    }
}