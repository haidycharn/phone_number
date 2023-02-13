<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends CI_Controller {

	public function __construct()
    {
		parent :: __construct();
		$this->load->model('phone_model');
    }

	public function index()
	{
		$customers = $this->phone_model->getCustomers();
		$countries = getCountryName();

		foreach($customers as $key => &$customer) {
			$phone_lib =new Phone_number_lib;
			$customer = $phone_lib->validate_phonenumber($customer['phone']);
		}
		$data['customers'] = $customers;
		$data['countries'] = $countries;
		$this->load->view('header');
		$this->load->view('index', $data);
		$this->load->view('footer');
	}
}
