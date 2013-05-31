<?php

/**
 * this is a model to take care of registration related db activities
 */
class Registration extends CI_Model {
	
	function index() {
		
	}
	
	function enter_registration_data($userdata){
				
		$firstname = $userdata['firstname'];
		 $lastname = $userdata['lastname'];
		 $email = $userdata['emailid'];
		 $phone = $userdata['phone'];
		 $username = $userdata['username'];
		 $password = $userdata['password'];
 		
		$query = 'insert into cb_registration values(null,"'.$firstname.'", "'.$lastname.'", "'.$email.'", '.$phone.')';		
		 $q = $this->db->query($query);  
		 
		 $user_id = $this->db->insert_id();
		 
		$query1 = 'insert into cb_login_details values('.$user_id.', "'.$username.'", "'.$password.'")';
		$q1 = $this->db->query($query1);
		
		if($q && $q1) {
		 	return 1;
		 }
		 else {
			 return 0;
		 }		 
	}
	
	
	function is_user_existing($userdata){		 
		
		if (array_key_exists('emailid', $userdata)) {
				
			$query = 'select email_id from cb_registration where email_id = "'.$userdata['emailid'].'"';
			
			$q = $this->db->query($query);
			
			if($q->num_rows() > 0)
			{
				return "Invalid email or Email address already exist in database, please enter another email address";
			}
			$q->free_result();
		}	
		
		 if (array_key_exists('username', $userdata)) {
    		$query = 'select username from cb_login_details where username = "'.$userdata['username'].'"';
			$q = $this->db->query($query);
			
			if($q->num_rows() > 0)
			{
				return "Invailid username or Username already exists, please choose another username";   
			}
			$q->free_result();			 
		}
		 
		if (array_key_exists('phone', $userdata)) {
    		$query = 'select phone from cb_registration where phone = '.$userdata['phone'];
			$q = $this->db->query($query);
			
			if($q->num_rows() > 0)
			{
				return "invalid phone number or Phone number already exists in the database, please enter another phone number";
			}
			$q->free_result();			 
		}
		
		return 1; 		
	}

	function login_validate(){
	
		$this->db->where('username', $this->input->post('login_username'));
		$this->db->where('password', $this->input->post('login_password'));
		$query = $this->db->get('cb_login_details');
				
		if($query->num_rows == 1)
		{
			//$query2 = 'SELECT user_id from cb_login_details WHERE username="'.$this->input->post('login_username').'"';
			//$q = $this->db->query($query);
			
			//foreach ($q->result() as $row) {
			//	$user_id = $row->user_id;
			//}
			//$this->session->set_userdata('user_id', $user_id);
			$this->session->set_userdata('username', $this->input->post('login_username'));
			return true;
		}
	}
}