<?php

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mperusahaan');

	}
	function render_page($content, $data = NULL)
	{
		$data['profil'] = $this->Mperusahaan->profil();
		$data['sidebar'] = $this->load->view('backend/sidebar', $data, TRUE);
		$data['content'] = $this->load->view($content, $data, TRUE);
		$this->load->view('backend/index', $data);
	}
}
?>