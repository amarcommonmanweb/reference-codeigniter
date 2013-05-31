<?php

/**
 * The main controller for the site
 */
class Website_page extends CI_Controller {
	
	function index() {
		$data['page_load'] = 'vw_website_page';
		$this->load->view('includes/main_template', $data);
	}
}
