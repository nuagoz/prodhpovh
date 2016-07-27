<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->layout->views('header')->view('rank');
	}

}
