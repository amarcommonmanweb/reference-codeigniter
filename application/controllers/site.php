<?php

class Site extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}

	function members_area()
	{
		$data['page_load'] = 'logged_in_area';
		$this->load->view('includes/main_template', $data);	
		//finally go to the main place
	}
		
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			echo 'You don\'t have permission to access this page. <a href="../login">Login</a>';	
			die();		
			
		}		
	}
	
	function get_states(){
		$this->load->model('site_model');
		$result = $this->site_model->get_states();
		
		echo "$result";
	}	

	function get_catagory(){
		$this->load->model('site_model');
		$result = $this->site_model->get_catagory();
		
		echo "$result";
	}
	
	function get_cities(){
		$this->load->model('site_model');
		$result = $this->site_model->get_cities();
		
		echo $result;
	}
	
	function get_schools(){
		$this->load->model('site_model');
		$result = $this->site_model->get_schools();
		
		echo $result;
	}
	
	function get_presence_cities(){
		$this->load->model('site_model');
		$result = $this->site_model->get_presence_cities();
		
		echo "$result";
		
	}
	
	function save_candidate_data(){
		
		$this->load->model('site_model');
		$result = $this->site_model->save_candidate_data();
		
		print_r($result);
	}
	
	function admission_test_dates(){
		$data['page_load'] = 'admission_test_page';
		$this->load->view('includes/main_template', $data);	
	}
	
	
	
	
}
