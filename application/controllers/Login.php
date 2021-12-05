<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);
		$this->load->model('Admin_model', 'admin');
		if($this->session->userdata('user_id')){
			redirect('dashboard');
		}
	}

	public function index()
	{
		$this->load->view("{$this->controller}/{$this->controller}");
	}

	public function login()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]');

			if ($this->form_validation->run() == FALSE) {
				$errors['email'] = form_error('email', '<span class="help-block email">', '</span>');
				$errors['password'] = form_error('password', '<span class="help-block password">', '</span>');
				echo json_encode(['status' => $errors]);
			}else{
				$user = $this->admin->login($this->input->post('email'), $this->input->post('password'));
				if($user){
					$this->session->set_userdata(['user_id' => $user->id, 'email' => $user->email, 'name' => $user->name]);
					$this->session->set_flashdata('success', "Hi $user->name, Welcome to zocmodz admin area...");
					echo json_encode(['status' => 'success']);
				}else{
					echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
				}
			}
			
		}
	}	
}
