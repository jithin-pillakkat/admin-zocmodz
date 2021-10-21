<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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

    public function create()
	{	
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/".__FUNCTION__);
	}

    public function store()
	{	
        
	}

    public function edit()
	{	
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/".__FUNCTION__);
	}

    public function update()
	{	
        
	}

    public function destroy()
	{	
        
	}

	
}
