<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tulis_pengaduan extends CI_Controller {

	public function index()
	{
        $this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('tulis_aduan');
		$this->load->view('templates/footer');
	}
}