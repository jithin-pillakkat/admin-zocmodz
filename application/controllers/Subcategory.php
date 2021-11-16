<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategory extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);
		$this->load->model('Subcategory_model', 'subcategory');
		$this->load->model('Product_model', 'product');
	}

	public function index()
	{
		$data['categories'] = $this->subcategory->getCategories();
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}", $data);
	}

	public function create()
	{
		$data['categories'] = $this->subcategory->getCategories();
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/" . __FUNCTION__, $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('title', 'Subcategory Name', 'required|min_length[3]|max_length[50]|callback_checkExist');
		$this->form_validation->set_rules('image', '', 'callback_fileCheck');
		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			$data['slug'] = $this->security->xss_clean(url_title($data['title'], 'dash', true));

			$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
			$image = $data['slug'] . time(). '.' . $ext;
			$uplPath = FCPATH . 'uploads/subcategory/';
			$uploadPath = $uplPath . $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

			$data['image'] = $image;

			$insertId = $this->subcategory->store($data);
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
		$data['categories'] = $this->subcategory->getCategories();
		$data['subcategory'] = $this->subcategory->getSubcategory($id);
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/" . __FUNCTION__, $data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$himage = $this->input->post('himage');
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('title', 'Subcategory Name', 'required|min_length[3]|max_length[50]|callback_checkExistEdit');
		if ($_FILES['image']['name'] != '') {
			$this->form_validation->set_rules('image', '', 'callback_fileCheck');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id);
		} else {
			$data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			$data['slug'] = $this->security->xss_clean(url_title($data['title'], 'dash', true));
			if ($_FILES['image']['name'] != '') {
				// remove old image
				unlink(FCPATH . 'uploads/subcategory/' . $himage);

				$ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$image = $data['slug'] . time() . '.' . $ext;
				$uplPath = FCPATH . 'uploads/subcategory/';
				$uploadPath = $uplPath . $image;
				move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

				$data['image'] = $image;
			}
			$update = $this->subcategory->update($data, $id);
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
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$id = $this->input->get('id');
			$data = $this->subcategory->getSubcategory($id);
			
			// Delete products under this subcategory
			$products = $this->subcategory->getProducts($id);
			foreach($products as $product){
				if($product->image_1){
					unlink(FCPATH . 'uploads/product/' . $product->image_1);
				}
				if($product->image_2){
					unlink(FCPATH . 'uploads/product/' . $product->image_2);
				}
				if($product->image_3){
					unlink(FCPATH . 'uploads/product/' . $product->image_3);
				}
				if($product->image_4){
					unlink(FCPATH . 'uploads/product/' . $product->image_4);
				}

				$this->product->destroy($product->id);
			}

			unlink(FCPATH . 'uploads/subcategory/' . $data->image);
			$destroy = $this->subcategory->destroy($id);
			if ($destroy) {
				echo json_encode(['status' => 'success', 'message' => 'Data deleted successfully.']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Somthing went wrong']);
			}
		}
	}

	public function table()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$search = $_GET['search']['value'];

			if (isset($_GET['order'])) {
				$order = $_GET['order'];
			} else {
				$order = '';
			}

			if (isset($_GET['order']['0']['column'])) {
				$order_column = $_GET['order']['0']['column'];
			} else {
				$order_column = '';
			}

			if (isset($_GET['order']['0']['dir'])) {
				$order_dir = $_GET['order']['0']['dir'];
			} else {
				$order_dir = '';
			}

			$start = $_GET['start'];
			$length = $_GET['length'];

			if(isset($_GET['category_id'])){
				$category_id = $_GET['category_id'];				
			}else{
				$category_id = 0;
			}

			$draw = $_GET['draw'];

			$categories = $this->subcategory->getSubcategories($search, $order, $order_column, $order_dir, $start, $length, $category_id, $draw);
			echo json_encode($categories);
		}
	}

	public function changeStatus()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$id = $this->input->get('id');
			$status = $this->input->get('status');
			if ($status == 1) {
				$statusValue = 2;
				$message = 'Deactivated successfully.';
				$newStatus = 'deactive';
			} else {
				$statusValue = 1;
				$message = 'Activated successfully.';
				$newStatus = 'active';
			}
			$changeStatus = $this->subcategory->update(['subcategory_status' => $statusValue], $id);
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
				if ($_FILES['image']['size'] > 1048576) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 1MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image']['tmp_name']);
				if ($image_info[0] > 520 || $image_info[1] > 410 || $image_info[0] < 320 || $image_info[1] < 320) {
					$this->form_validation->set_message('fileCheck', 'Please upload min [width:320px height:320px] and max[width:520 height:410] image.');
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

	/*
     * check exist during validation
     */
	function checkExist($title)
	{		
		$categoryId = $this->input->post('category_id');
		$result = $this->subcategory->checkExist($categoryId, $title);		
		if ($result == 0)
			return true;
		else {
			$this->form_validation->set_message('checkExist', 'Subcategory name must be unique under this category');
			return false;
		}
	}

	/*
     * check exist during edit validation
     */
	function checkExistEdit($title)
	{
		$id = $this->input->post('id');
		$categoryId = $this->input->post('category_id');
		$result = $this->subcategory->checkExistEdit($id, $categoryId, $title);			
		if ($result == 0)
			return true;
		else {
			$this->form_validation->set_message('checkExistEdit', 'Subcategory name must be unique under this category');
			return false;
		}
	}
}
