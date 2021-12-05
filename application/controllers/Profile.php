<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);
		$this->load->model('Admin_model', 'admin');
	}

	public function index()
	{
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}");
	}

	public function update_profile()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[10]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[50]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[10]');
			if ($this->form_validation->run() == FALSE) {
				$errors['name'] = form_error('name', '<span class="help-block name">', '</span>');
				$errors['email'] = form_error('email', '<span class="help-block email">', '</span>');
				$errors['password'] = form_error('password', '<span class="help-block password">', '</span>');
				echo json_encode(['status' => $errors]);
			} else {
				$data = [
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'password' => md5($this->input->post('password'))
				];
				$user = $this->admin->update_profile($data);
				if ($user) {
					$this->session->set_userdata(['email' => $user->email, 'name' => $user->name]);					
					echo json_encode(['status' => 'success', 'message' => 'Updated successfully.']);
				} else {
					echo json_encode(['status' => 'warning', 'message' => 'Profile details not changed.']);
				}
			}
		}
	}

	public function update_twitter()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('twitter', 'Twitter', 'trim|required|valid_url');
			
			if ($this->form_validation->run() == FALSE) {
				$errors['twitter'] = form_error('twitter', '<p>', '</p>');
				
				echo json_encode(['status' => $errors]);
			} else {
				$data = ['link' => $this->input->post('twitter')];
				$update = $this->admin->update_socialmedia($data, 1);				
				if ($update) {									
					echo json_encode(['status' => 'success', 'message' => 'Link Updated successfully.']);
				} else {
					echo json_encode(['status' => 'warning', 'message' => 'Link not changed.']);
				}
			}
		}
	}

	public function update_facebook()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim|required|valid_url');
			
			if ($this->form_validation->run() == FALSE) {
				$errors['facebook'] = form_error('facebook', '<p>', '</p>');
				
				echo json_encode(['status' => $errors]);
			} else {
				$data = ['link' => $this->input->post('facebook')];
				$update = $this->admin->update_socialmedia($data, 2);
				if ($update) {									
					echo json_encode(['status' => 'success', 'message' => 'Link Updated successfully.']);
				} else {
					echo json_encode(['status' => 'warning', 'message' => 'Link not changed.']);
				}
			}
		}
	}

	public function update_instagram()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('instagram', 'Instagram', 'trim|required|valid_url');
			
			if ($this->form_validation->run() == FALSE) {
				$errors['instagram'] = form_error('instagram', '<p>', '</p>');
				
				echo json_encode(['status' => $errors]);
			} else {
				$data = ['link' => $this->input->post('instagram')];
				$update = $this->admin->update_socialmedia($data, 2);
				if ($update) {									
					echo json_encode(['status' => 'success', 'message' => 'Link Updated successfully.']);
				} else {
					echo json_encode(['status' => 'warning', 'message' => 'Link not changed.']);
				}
			}
		}
	}

	public function update_youtube()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$this->form_validation->set_rules('youtube', 'Youtube', 'trim|required|valid_url');
			
			if ($this->form_validation->run() == FALSE) {
				$errors['youtube'] = form_error('youtube', '<p>', '</p>');
				
				echo json_encode(['status' => $errors]);
			} else {
				$data = ['link' => $this->input->post('youtube')];
				$update = $this->admin->update_socialmedia($data, 2);
				if ($update) {									
					echo json_encode(['status' => 'success', 'message' => 'Link Updated successfully.']);
				} else {
					echo json_encode(['status' => 'warning', 'message' => 'Link not changed.']);
				}
			}
		}
	}
}
