<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);	
		$this->load->model('Banner_model', 'banner');	
	}

	public function index()
	{	
		$data['banners'] = $this->banner->getBanners();
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}", $data);
	}

    public function create()
	{	
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/".__FUNCTION__);
	}

    public function store()
	{	
        $this->form_validation->set_rules('title', 'Banner Title', 'required|min_length[3]|max_length[50]');
		$this->form_validation->set_rules('image', '', 'callback_fileCheck');
		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			
			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$image = url_title($data['title'], 'dash', true) . '.' . $ext;
			$uplPath = FCPATH . 'uploads/banner/';
			$uploadPath = $uplPath . $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

			$data['image'] = $image;

			$insertId = $this->banner->store($data);
			if ($insertId) {
				$this->session->set_flashdata('success', 'Data saved successfully.');
				return redirect($this->controller);
			} else {
				$this->session->set_flashdata('error', 'Data insertion failed, please try again!');
				return redirect($this->create());
			}
		}
	}

    public function edit($id)
	{	
		$data['banner'] = $this->banner->getBanner($id);
        $this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/".__FUNCTION__, $data);
	}

    public function update()
	{	
        $id = $this->input->post('id');
		$himage = $this->input->post('himage');
		$this->form_validation->set_rules('title', 'Banner Title', 'required|min_length[3]|max_length[50]');
		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', '', 'callback_fileCheck');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id);
		} else {
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			
			if ($_FILES['image']['name'] != '') {
				// remove old image
				unlink(FCPATH . 'uploads/banner/' . $himage);

				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$image = $data['slug'] . '.' . $ext;
				$uplPath = FCPATH . 'uploads/banner/';
				$uploadPath = $uplPath . $image;
				move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

				$data['image'] = $image;
			}
			$update = $this->banner->update($data, $id);
			if ($update) {
				$this->session->set_flashdata('success', 'Data updated successfully.');
				return redirect($this->controller);
			} else {
				$this->session->set_flashdata('error', 'Data updation failed, please try again!');
				return redirect($this->edit($id));
			}
		}
	}

    public function destroy()
	{	
        
	}

	public function changeStatus()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$id = $this->input->get('id');
			$status = $this->banner->getBanner($id);			
			if ($status->banner_status == 1) {
				$statusValue = 2;
				$message = 'Deactivated successfully.';
				$newStatus = 'deactive';
			} else {
				$statusValue = 1;
				$message = 'Activated successfully.';
				$newStatus = 'active';
			}
			$changeStatus = $this->banner->update(['banner_status' => $statusValue], $id);
			if ($changeStatus) {
				echo json_encode(['status' => $newStatus, 'message' => $message]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Somthing went wrong']);
			}
		}
	}

	/*
     * file value and type check during validation
     */
	public function fileCheck($str)
	{
		$allowed_mime_type_arr = ['image/jpeg', 'image/png'];
		$mime = get_mime_by_extension($_FILES['image']['name']);
		if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_arr)) {
				if ($_FILES['image']['size'] > 2097152) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 2MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image']['tmp_name']);
				
				if ($image_info[0] != 1555 || $image_info[1] != 1005 ) {
					$this->form_validation->set_message('fileCheck', 'Please upload [width:1555 height:1005] image.');
					return false;
				}
				return true;
			} else {
				$this->form_validation->set_message('fileCheck', 'Please select only jpg/png file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('fileCheck', 'Please choose a image to upload.');
			return false;
		}
	}
}
