<?php

/**
 * the login , sign up and all that related untill it reaches the main content
 */		
class Login extends CI_Controller {
	
	function index() {
		$data['page_load'] = 'login_page';
		$this->load->view('includes/main_template', $data);
	}
	
	function validate_credentials()
	{		
		$this->load->model('registration');
		$query = $this->registration->login_validate();
	
		if($query) // if the user's credentials validated...
		{
			$data = array(
				'username' => $this->input->post('login_username'),
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);
			echo 'true';
		}
		else // incorrect username or password
		{
			echo "Invalid Credentials, please try again...";
		}
	}	
	
	function validate_register(){
		/* 
		 * we get the form details here ,, need to validate with database 
		 * and enter detials in db and return true or not
		 * else return suitable error messages that ll be displayed in the red error box 
		 */
		 
		 $this->load->model('registration');
		 $result = $this->registration->enter_registration_data($_POST);
		 		 
		 if($result){
		 	echo "true";
		}		 
		else{
			
			echo "Error while entering values into the database .. ";
						
		}
		
	}
	
	function is_user_existing(){
		/*
		 * Here we chaeck is the user credentials 
		 * username or email or phone is available already
		 */
		 
		 $this->load->model('registration');
		 $result = $this->registration->is_user_existing($_POST);
		 
		 if($result == 1){
			echo "true";
		}		 
		else{
			echo "Error: ".$result;
						
		}
	}
	
	function registration_success(){
		/*
		 * send back a congratulation message and a link to login
		 * this will replace all the login content
		 */
		$urladdress = "http://localhost/CodeIgniter/index.php/login";
		echo 'congratulations!!! you have successfully registered , continue to <a href="'.$urladdress.'">Login</a>';
	}
	
}