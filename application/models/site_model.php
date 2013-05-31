<?php

/**
 * this is a model to take care of registration related db activities
 */
class Site_model extends CI_Model {
	
	var $upload_file_path;
	
	function __construct()
	{
		parent::__construct();
		
		$this->upload_file_path = realpath(APPPATH.'../uploads');
	}
	
	function index() {
		
	}
	
	function get_states(){
		$query = 'select distinct state_name from cb_cities order by state_name';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			$ret_string = '<option value="0">Select State</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value="'.$row->state_name.'">'.$row->state_name.'</option>';
			}
			
		}
		return $ret_string;
	}
	
	function get_presence_cities(){
		$query = 'select distinct cty.city_id, cty.city_name from cb_cities cty, cb_presence_cities cpc where cty.city_id = cpc.city_id order by cty.city_name';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			
			$ret_string = '<option value=0>Select City</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			}
		}
		
		return $ret_string;	
	}
	
	
	function get_catagory(){
		$query = 'select distinct catagory_id, catagory_name from cb_cand_catagory_lkup';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			$ret_string = '<option value=0>Select Category</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value="'.$row->catagory_id.'">'.$row->catagory_name.'</option>';
			}
			
		}
		return $ret_string;
	}
	
	function get_cities(){
		
		$state_name = $this->input->post('state_name');
		$fill_id = $this->input->post('fill_id');
		$city_sel_id = $this->input->post('city_sell_id');
		$width = $this->input->post('width');
		
		$query = 'select city_id, city_name from cb_cities where state_name = "'.$state_name.'" order by city_name';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			
			$ret_string = '<option value=0>Select City</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value="'.$row->city_id.'">'.$row->city_name.'</option>';
			}
		}
		
		return $ret_string;	
	}

	function get_schools(){
		
		$city_id = $this->input->post('city_id');

		
		$query = 'select sch.school_id, sch.school_name from cb_presence_schools sch, cb_presence_cities cts where cts.city_id = '.$city_id.' and sch.school_id = cts.school_id';
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			
			$ret_string = '<option value=0>Select School</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value="'.$row->school_id.'">'.$row->school_name.'</option>';
			}
		}
		
		return $ret_string;		
		
	}
	
	function save_candidate_data(){
		
		//well the input post function of hte codeignitertakes care of the escaping of hte characters ..so i ll directly usethem
		$select_city = $this->input->post('select_city');
		$select_school = $this->input->post('select_school');
		$catagory = $this->input->post('catagory');
		$firstname = $this->input->post('firstname');
		$middlename = $this->input->post('middlename');
		$lastname = $this->input->post('lastname');
		$gender = $this->input->post('gender');
		$date_of_birth = $this->input->post('date_of_birth');
		$nationality = $this->input->post('nationality');
		$fathers_name = $this->input->post('fathers_name');
		$mothers_name = $this->input->post('mothers_name');
		$res_address_line1 = $this->input->post('res_address_line1');
		$res_address_line2 = $this->input->post('res_address_line2');
		$res_state = $this->input->post('res_state');
		$res_city = $this->input->post('res_city');
		$res_pin_code = $this->input->post('res_pin_code');
		$res_phone1 = $this->input->post('res_phone1');
		$res_phone2 = $this->input->post('res_phone2');
		$res_email = $this->input->post('res_email');
		$permanent_address_line1 = $this->input->post('permanent_address_line1');
		$permanent_address_line2 = $this->input->post('permanent_address_line2');
		$permanent_state = $this->input->post('permanent_state');
		$permanent_city = $this->input->post('permanent_city');
		$permanent_pin_code = $this->input->post('permanent_pin_code');
		$permanent_phone1 = $this->input->post('permanent_phone1');
		$permanent_phone2 = $this->input->post('permanent_phone2');
		$permanent_email = $this->input->post('permanent_email');
		
		
		$day_or_hostel = ($this->input->post('day_or_hostel') == '')?NULL:$this->input->post('day_or_hostel');
		
		$addmn_test_marks = ($this->input->post('addmn_test_marks') == '')?NULL:$this->input->post('addmn_test_marks');
				
		//till here are the ones that are fixed ... hence we can directly use and test them ..
		//coz after this arrays are passed into the post
		$sess_user_id = $this->session->userdata('user_id');;
		
		date_default_timezone_set('Asia/Calcutta');   // setting hte indian time zone
		$datetime = date('Y-m-d H:i:s',time());  //if an error or mismatch in date .. try setting the timezone
		
		$date_of_birth = str_replace("/","-",$date_of_birth);
		$todate = strtotime($date_of_birth);
		$dob_date = date("Y-m-d", $todate);
		
		if($sess_user_id == ''){$sess_user_id=00;}
		$query = 'INSERT INTO cb_canditates values (null, '.$sess_user_id.','.$catagory.',"'.$firstname.'","'.$middlename.'","'.$lastname.'","'.$gender.'","'.$dob_date.'",'.$nationality.',"'.$fathers_name.'","'.$mothers_name.'","'.$datetime.'","'.$day_or_hostel.'",'.$addmn_test_marks.')';
		$q1 = $this->db->query($query);  
		 
		$candidate_id = $this->db->insert_id();
		//adding this now to the session
		$data = array(
				'candidate_id' => $candidate_id
				);
		$this->session->set_userdata($data);
		


		$query = 'INSERT INTO cb_addresses values ('.$candidate_id.',"'.$res_address_line1.'","'.$res_address_line2.'",'.$res_city.','.$res_pin_code.','.$res_phone1.','.$res_phone2.',"'.$res_email.'",1)';
		$q2 = $this->db->query($query); 
		
		$query = 'INSERT INTO cb_addresses values ('.$candidate_id.',"'.$permanent_address_line1.'","'.$permanent_address_line2.'",'.$permanent_city.','.$permanent_pin_code.','.$permanent_phone1.','.$permanent_phone2.',"'.$permanent_email.'",2)';
		$q3 = $this->db->query($query);
	
		$pre_edu_school_name = $this->input->post('pre_edu_school_name');
		//$pre_edu_state = $this->input->post('pre_edu_state');
		$pre_edu_city = $this->input->post('pre_edu_city');
		$pre_edu_from = $this->input->post('pre_edu_from');
		$pre_edu_to = $this->input->post('pre_edu_to');		
			
		//form the insert string now	
		$query = 'INSERT INTO cb_prev_edu values ';	
		foreach ($pre_edu_school_name as $key => $value) {
			$pre_edu_from_temp = str_replace("/","-",$pre_edu_from[$key]);
			$todate = strtotime($pre_edu_from_temp);
			$pre_edu_from_temp = date("Y-m-d", $todate);
		
			$pre_edu_to_temp = str_replace("/","-",$pre_edu_to[$key]);
			$todate = strtotime($pre_edu_to_temp);
			$pre_edu_to_temp = date("Y-m-d", $todate);

			if($key != 0){$query .= ',';}
			$query .= '('.$candidate_id.',"'.$pre_edu_school_name[$key].'",'.$pre_edu_city[$key].',"'.$pre_edu_from_temp.'","'.$pre_edu_to_temp.'")';		

		}
		
		$q4 = $this->db->query($query);

		$sibl_name = $this->input->post('sibl_name');
		$sibl_gender = $this->input->post('sibl_gender');
		$sibl_dob = $this->input->post('sibl_dob');
		$sibl_school = $this->input->post('sibl_school');
		$sibl_class = $this->input->post('sibl_class');

		$query = 'INSERT INTO cb_siblings values ';	
		foreach ($sibl_name as $key => $value) {
			$sibl_dob_temp = str_replace("/","-",$sibl_dob[$key]);
			$todate = strtotime($sibl_dob_temp);
			$sibl_dob_temp = date("Y-m-d", $todate);

			if($key != 0){$query .= ',';}
			$query .= '('.$candidate_id.',"'.$sibl_name[$key].'","'.$sibl_gender[$key].'","'.$sibl_dob_temp.'","'.$sibl_school[$key].'","'.$sibl_class[$key].'")';		

		}
		$q5 = $this->db->query($query);

		$selec_school_list = $this->input->post('selected_schools');
		//this is commming in as a csv .. hence we can split it
		
		$splits = explode(",", $selec_school_list);

		$query = 'INSERT INTO cb_selected_schools values ';
		foreach ($splits as $key => $value) {
					
			if($key != 0){$query .= ',';}
			$query .= '('.$candidate_id.','.$value.')';		

		}
		$q6 = $this->db->query($query);
		
		//first just get all the post values into the variables
		
		if(!$q1)
		{
			return 'error in inserting personal details';
		}
		if(!$q2)
		{
			return 'error in inserting address 1';
		}
		if(!$q3)
		{
			return 'error in inserting address 2';
		}
		if(!$q4)
		{
			return 'error in inserting previous education details';
		}
		if(!$q5)
		{
			return 'error in inserting siblings details';
		}
		if(!$q6)
		{
			return 'error in inserting mapping of schools applied for';
		} 

		return 'true';

	}

}