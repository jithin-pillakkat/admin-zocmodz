<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);		
	}

	public function index()
	{	
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}");
	}

	
}
