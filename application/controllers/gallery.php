<?php
class Gallery extends CI_Controller {
	
	function index() {
		
		$this->load->model('Gallery_model');
		
		if ($this->input->post('upload') && ($this->input->post('doc_name') != 0)) {
			$this->Gallery_model->do_upload();
			
			/* not yet .. this ll be done on clicking done*/
			//$this->load->model('gallery_model');
			//$result = $this->gallery_model->update_docs_db($_FILES['userfile']['name']);
			
		}

		if($this->input->post('doc_name') == 0){
			$data['error_data'] = "Please select the <strong>Document Name</strong> before uploading";			
		}
		else {
			$data['error_data'] = "success";
		}
		
		$data['images'] = $this->Gallery_model->get_images();		
		$this->load->view('gallery', $data);
		
	}
	
	function delete_doc(){
		$doc_url = $this->input->post('doc_url');
		
		$url_pieces = explode("/", $doc_url);
		$pieces_size = sizeof($url_pieces);
		$relative_url = $url_pieces[$pieces_size - 2].'/'.$url_pieces[$pieces_size - 1];
		if(unlink($relative_url))
		{
			echo "done";
		}
		else {
			echo "error";
		}
	}
	
	function get_docs(){
		
		
		$this->load->model('gallery_model');
		$result = $this->gallery_model->get_docs();
		
		echo "$result";
	}

	function update_doc_db(){
		$this->load->model('gallery_model');
		$result = $this->gallery_model->update_docs_db();
		
		echo "$result";
	}
	
}
