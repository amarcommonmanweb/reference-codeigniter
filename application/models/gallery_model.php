<?php
class Gallery_model extends CI_Model {
	
	var $gallery_path;
	var $gallery_path_url;
	
	function __construct() {
		parent::__construct();
		
		$sess_array = $this->session->all_userdata();
		$candidate_id = $sess_array['candidate_id'];
		
		$this->gallery_path = realpath(APPPATH . '../uploads');
		$this->gallery_path_url = base_url().'uploads/';
				
	}
	
	function do_upload() {
		
		$sess_array = $this->session->all_userdata();
		$candidate_id = $sess_array['candidate_id'];
		$doc_catagory = $this->input->post('doc_name');
		$filename = $_FILES['userfile']['name'];
		$filename = $candidate_id.'_'.$doc_catagory.'_'.$filename;
		// file name is saved like this through out .. but when the user has to se.. it is trimmed out in the view
		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png|doc|docx|pdf',
			'upload_path' => $this->gallery_path,
			'max_size' => 2000,
			'file_name' => $filename
		);
		
		$this->load->library('upload', $config);
		$this->upload->do_upload();
		$image_data = $this->upload->data();
	/*
	 *more .. commenting the below part as we doneed thumbs any
	 *	
		$config = array(
			'source_image' => $image_data['full_path'],
			'new_image' => $this->gallery_path . '/thumbs',
			'maintain_ration' => true,
			'width' => 150,
			'height' => 100
		);
		
		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		
	 * 
	 * 
	 * 
	 */
		//start to update details in the database table
		
		//$query = 'INSERT INTO cb_documents_log values (22,)';
		//$q = $this->db->query($query);
		
	}
	
	function get_images() {
		
		$files = scandir($this->gallery_path);
		$files = array_diff($files, array('.', '..', 'thumbs'));
		
		$images = array();
		
		foreach ($files as $file) {
			$images []= array (
				'url' => $this->gallery_path_url . $file,
			);
			
			/*$images []= array (
				'url' => $this->gallery_path_url . $file,
				'thumb_url' => $this->gallery_path_url . 'thumbs/' . $file
			);*/
		}
		
		return $images;
	}
	
	function get_docs(){
		//get candidates category first and then fetch the necessary documents
		$sess_array = $this->session->all_userdata();
		$candidate_id = $sess_array['candidate_id'];
		
		$query = 'select c_catagory from cb_canditates where c_id = '.$candidate_id;
		$c_catagory = '';
		$q0 = $this->db->query($query);  
		if($q0->num_rows() > 0){
			
			foreach ($q0->result() as $row) {
				$c_catagory = $row->c_catagory;
			}
			
		}
		$data = array(
				'c_catagory' => $c_catagory
				);
		$this->session->set_userdata($data);
		
		$query = 'select doc_id, doc_name from cb_doc_lkup where cand_category = '.$c_catagory;
		$q = $this->db->query($query);  
		
		if($q->num_rows() > 0){
			$ret_string = '<option value="0">Select Category</option>';
			foreach ($q->result() as $row) {
				$ret_string .= '<option value='.$row->doc_id.'>'.$row->doc_name.'</option>';
			}
			
		}
		return $ret_string;
	}

	function update_docs_db(){
		$files = scandir($this->gallery_path);
		$files = array_diff($files, array('.', '..', 'thumbs'));
		
		$images = array();
		
		foreach ($files as $file) {
			$images []= array (
				'url' => $this->gallery_path_url . $file,
			);
		}
		
		$query = 'INSERT INTO cb_documents_log (c_id,document_name,file_name) values ';
		$key = 0;
		foreach($images as $image){
			
			$url_pieces = explode("/", $image['url']);
			$pieces_size = sizeof($url_pieces);
			$filename_pieces = explode("_", $url_pieces[$pieces_size - 1]);
			
			if($key != 0){$query .= ',';}
			$query .= '('.$filename_pieces[0].','.$filename_pieces[1].',"'.$filename_pieces[2].'")';
			$key = 1;
		}	
		$q = $this->db->query($query);
	
		if($q){
			return 'done';
		}
		else {
			return "Error in uploading documents, Please try again!!";
		}
	}

}



