<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);

		$this->load->model('Product_model', 'product');
	}

	public function index()
	{
		$data['categories'] = $this->product->getCategories();
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}", $data);
	}

	public function create()
	{
		$data['categories'] = $this->product->getCategories();
		$data['gsts'] = $this->product->getGsts();
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/" . __FUNCTION__, $data);
	}

	public function store()
	{
		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('subcategory_id', 'Subcategory Name', 'required');
		$this->form_validation->set_rules('title', 'Product Name', 'required|min_length[3]|max_length[100]|callback_checkExist');
		$this->form_validation->set_rules('quantity', 'Product Quantity', 'required|numeric');
		$this->form_validation->set_rules('price', 'Product Price', 'required|numeric');
		$this->form_validation->set_rules('discount', 'Product Discount', 'required|is_natural');
		$this->form_validation->set_rules('gst', 'GST Percentage', 'required');
		$this->form_validation->set_rules('description', 'Product Description', 'required|min_length[3]');
		$this->form_validation->set_rules('image_1', '', 'callback_fileCheck_1');
		if ($_FILES['image_2']['name']) {
			$this->form_validation->set_rules('image_2', '', 'callback_fileCheck_2');
		}
		if ($_FILES['image_3']['name']) {
			$this->form_validation->set_rules('image_3', '', 'callback_fileCheck_3');
		}
		if ($_FILES['image_4']['name']) {
			$this->form_validation->set_rules('image_4', '', 'callback_fileCheck_4');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
			$data['subcategory_id'] = $this->security->xss_clean($this->input->post('subcategory_id'));
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			$data['slug'] = $this->security->xss_clean(url_title($data['title'], 'dash', true));
			$data['quantity'] = $this->security->xss_clean($this->input->post('quantity'));
			$data['price'] = $this->security->xss_clean($this->input->post('price'));
			$data['discount'] = $this->security->xss_clean($this->input->post('discount'));
			$data['gst'] = $this->security->xss_clean($this->input->post('gst'));
			$data['description'] = $this->security->xss_clean($this->input->post('description'));

			if ($data['discount'] > 0) {
				$discountAmount = ($data['price'] * $data['discount']) / 100;
				$data['app_price'] = $data['price'] - $discountAmount;
			} else {
				$data['app_price'] = $data['price'];
			}


			$ext = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);
			$image_1 = $data['slug'] . time() . '_1.' . $ext;
			$uplPath = FCPATH . 'uploads/product/';
			$uploadPath = $uplPath . $image_1;
			move_uploaded_file($_FILES['image_1']['tmp_name'], $uploadPath);
			$data['image_1'] = $image_1;

			if ($_FILES['image_2']['name']) {
				$ext = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);
				$image_2 = $data['slug'] . time() . '_2.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_2;
				move_uploaded_file($_FILES['image_2']['tmp_name'], $uploadPath);
				$data['image_2'] = $image_2;
			}

			if ($_FILES['image_3']['name']) {
				$ext = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);
				$image_3 = $data['slug'] . time() . '_3.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_3;
				move_uploaded_file($_FILES['image_3']['tmp_name'], $uploadPath);
				$data['image_3'] = $image_3;
			}

			if ($_FILES['image_4']['name']) {
				$ext = pathinfo($_FILES['image_4']['name'], PATHINFO_EXTENSION);
				$image_4 = $data['slug'] . time() . '_4.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_4;
				move_uploaded_file($_FILES['image_4']['tmp_name'], $uploadPath);
				$data['image_4'] = $image_4;
			}




			$insertId = $this->product->store($data);
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
		$data['product'] = $this->product->getProduct($id);
		$data['categories'] = $this->product->getCategories();
		$data['gsts'] = $this->product->getGsts();
		$data['subcategories'] = $this->product->getSubcategories($data['product']->category_id);
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/" . __FUNCTION__, $data);
	}

	public function update()
	{
		$id = $this->input->post('id');
		$himage_1 = $this->input->post('himage_1');
		$himage_2 = $this->input->post('himage_2');
		$himage_3 = $this->input->post('himage_3');
		$himage_4 = $this->input->post('himage_4');

		$this->form_validation->set_rules('category_id', 'Category Name', 'required');
		$this->form_validation->set_rules('subcategory_id', 'Subcategory Name', 'required');
		$this->form_validation->set_rules('title', 'Product Name', 'required|min_length[3]|max_length[100]|callback_checkExistEdit');
		$this->form_validation->set_rules('quantity', 'Product Quantity', 'required|numeric');
		$this->form_validation->set_rules('price', 'Product Price', 'required|numeric');
		$this->form_validation->set_rules('discount', 'Product Discount', 'required|is_natural');
		$this->form_validation->set_rules('description', 'Product Description', 'required|min_length[3]');

		if ($_FILES['image_1']['name'] != '') {
			$this->form_validation->set_rules('image_1', '', 'callback_fileCheck_1');
		}
		if ($_FILES['image_2']['name'] != '') {
			$this->form_validation->set_rules('image_2', '', 'callback_fileCheck_2');
		}
		if ($_FILES['image_3']['name'] != '') {
			$this->form_validation->set_rules('image_3', '', 'callback_fileCheck_3');
		}
		if ($_FILES['image_4']['name'] != '') {
			$this->form_validation->set_rules('image_4', '', 'callback_fileCheck_4');
		}

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id);
		} else {
			$data['category_id'] = $this->security->xss_clean($this->input->post('category_id'));
			$data['subcategory_id'] = $this->security->xss_clean($this->input->post('subcategory_id'));
			$data['title'] = $this->security->xss_clean($this->input->post('title'));
			$data['slug'] = $this->security->xss_clean(url_title($data['title'], 'dash', true));
			$data['quantity'] = $this->security->xss_clean($this->input->post('quantity'));
			$data['price'] = $this->security->xss_clean($this->input->post('price'));
			$data['discount'] = $this->security->xss_clean($this->input->post('discount'));
			$data['gst'] = $this->security->xss_clean($this->input->post('gst'));
			$data['description'] = $this->security->xss_clean($this->input->post('description'));

			if ($data['discount'] > 0) {
				$discountAmount = ($data['price'] * $data['discount']) / 100;
				$data['app_price'] = $data['price'] - $discountAmount;
			} else {
				$data['app_price'] = $data['price'];
			}

			// change image 1
			if ($_FILES['image_1']['name'] != '') {
				// remove old image
				if ($himage_1) {
					unlink(FCPATH . 'uploads/product/' . $himage_1);
				}

				$ext = pathinfo($_FILES['image_1']['name'], PATHINFO_EXTENSION);
				$image_1 = $data['slug'] . time() . '_1.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_1;
				move_uploaded_file($_FILES['image_1']['tmp_name'], $uploadPath);

				$data['image_1'] = $image_1;
			}

			// change image 2
			if ($_FILES['image_2']['name'] != '') {
				// remove old image
				if ($himage_2) {
					unlink(FCPATH . 'uploads/product/' . $himage_2);
				}

				$ext = pathinfo($_FILES['image_2']['name'], PATHINFO_EXTENSION);
				$image_2 = $data['slug'] . time() . '_2.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_2;
				move_uploaded_file($_FILES['image_2']['tmp_name'], $uploadPath);

				$data['image_2'] = $image_2;
			}

			if ($_FILES['image_3']['name'] != '') {
				// remove old image
				if ($himage_1) {
					unlink(FCPATH . 'uploads/product/' . $himage_3);
				}

				$ext = pathinfo($_FILES['image_3']['name'], PATHINFO_EXTENSION);
				$image_3 = $data['slug'] . time() . '.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_3;
				move_uploaded_file($_FILES['image_3']['tmp_name'], $uploadPath);

				$data['image_3'] = $image_3;
			}

			if ($_FILES['image_4']['name'] != '') {
				// remove old image
				if ($himage_4) {
					unlink(FCPATH . 'uploads/product/' . $himage_4);
				}

				$ext = pathinfo($_FILES['image_4']['name'], PATHINFO_EXTENSION);
				$image_4 = $data['slug'] . time() . '_4.' . $ext;
				$uplPath = FCPATH . 'uploads/product/';
				$uploadPath = $uplPath . $image_4;
				move_uploaded_file($_FILES['image_4']['tmp_name'], $uploadPath);

				$data['image_4'] = $image_4;
			}


			$update = $this->product->update($data, $id);
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
			$data = $this->product->getProduct($id);
			if ($data->image_1) {
				unlink(FCPATH . 'uploads/product/' . $data->image_1);
			}
			if ($data->image_2) {
				unlink(FCPATH . 'uploads/product/' . $data->image_2);
			}
			if ($data->image_3) {
				unlink(FCPATH . 'uploads/product/' . $data->image_3);
			}
			if ($data->image_4) {
				unlink(FCPATH . 'uploads/product/' . $data->image_4);
			}

			$destroy = $this->product->destroy($id);
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

			if (isset($_GET['category_id'])) {
				$category_id = $_GET['category_id'];
			} else {
				$category_id = 0;
			}

			if (isset($_GET['subcategory_id'])) {
				$subcategory_id = $_GET['subcategory_id'];
			} else {
				$subcategory_id = 0;
			}

			$draw = $_GET['draw'];

			$products = $this->product->getProducts($search, $order, $order_column, $order_dir, $start, $length, $category_id, $subcategory_id, $draw);
			echo json_encode($products);
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
			$changeStatus = $this->product->update(['product_status' => $statusValue], $id);
			if ($changeStatus) {
				echo json_encode(['status' => $newStatus, 'message' => $message]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Somthing went wrong']);
			}
		}
	}

	public function getSubcategories()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$categoryId = $this->input->get('categoryId');
			$subcategories = $this->product->getSubcategories($categoryId);
			$data = '<option value="">Select Subcategory</option>';
			foreach ($subcategories as $subcategory) {
				$selected = (set_value('subcategory_id') == $subcategory->id) ? 'selected' : '';
				$data .= '<option value="' . $subcategory->id . '" ' . $selected . '>' . $subcategory->title . '</option>';
			}
			echo $data;
		}
	}

	/*
     * file value and type check during validation
     */
	public function fileCheck_1($str)
	{
		$allowed_mime_type_arr = ['image/jpeg', 'image/png'];
		$mime = get_mime_by_extension($_FILES['image_1']['name']);
		if (isset($_FILES['image_1']['name']) && $_FILES['image_1']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_arr)) {
				if ($_FILES['image_1']['size'] > 1048576) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 1MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image_1']['tmp_name']);
				if ($image_info[0] > 520 || $image_info[1] > 410 || $image_info[0] < 320 || $image_info[1] < 320) {
					$this->form_validation->set_message('fileCheck_1', 'Please upload min [width:320px height:320px] and max[width:520 height:410] image.');
					return false;
				}
				return true;
			} else {
				$this->form_validation->set_message('fileCheck_1', 'Please select only jpg/png file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('fileCheck_1', 'Please choose a image to upload.');
			return false;
		}
	}

	public function fileCheck_2($str)
	{
		$allowed_mime_type_arr = ['image/jpeg', 'image/png'];
		$mime = get_mime_by_extension($_FILES['image_2']['name']);
		if (isset($_FILES['image_2']['name']) && $_FILES['image_2']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_arr)) {
				if ($_FILES['image_2']['size'] > 1048576) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 1MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image_2']['tmp_name']);
				if ($image_info[0] > 520 || $image_info[1] > 410 || $image_info[0] < 320 || $image_info[1] < 320) {
					$this->form_validation->set_message('fileCheck_2', 'Please upload min [width:320px height:320px] and max[width:520 height:410] image.');
					return false;
				}
				return true;
			} else {
				$this->form_validation->set_message('fileCheck_2', 'Please select only jpg/png file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('fileCheck_2', 'Please choose a image to upload.');
			return false;
		}
	}

	public function fileCheck_3($str)
	{
		$allowed_mime_type_arr = ['image/jpeg', 'image/png'];
		$mime = get_mime_by_extension($_FILES['image_3']['name']);
		if (isset($_FILES['image_3']['name']) && $_FILES['image_3']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_arr)) {
				if ($_FILES['image_3']['size'] > 1048576) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 1MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image_3']['tmp_name']);
				if ($image_info[0] > 520 || $image_info[1] > 410 || $image_info[0] < 320 || $image_info[1] < 320) {
					$this->form_validation->set_message('fileCheck_3', 'Please upload min [width:320px height:320px] and max[width:520 height:410] image.');
					return false;
				}
				return true;
			} else {
				$this->form_validation->set_message('fileCheck_3', 'Please select only jpg/png file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('fileCheck_3', 'Please choose a image to upload.');
			return false;
		}
	}

	public function fileCheck_4($str)
	{
		$allowed_mime_type_arr = ['image/jpeg', 'image/png'];
		$mime = get_mime_by_extension($_FILES['image_4']['name']);
		if (isset($_FILES['image_4']['name']) && $_FILES['image_4']['name'] != "") {
			if (in_array($mime, $allowed_mime_type_arr)) {
				if ($_FILES['image_4']['size'] > 1048576) {
					$this->form_validation->set_message('fileCheck', 'Please upload below 1MB file.');
					return false;
				}
				$image_info = getimagesize($_FILES['image_4']['tmp_name']);
				if ($image_info[0] > 520 || $image_info[1] > 410 || $image_info[0] < 320 || $image_info[1] < 320) {
					$this->form_validation->set_message('fileCheck_4', 'Please upload min [width:320px height:320px] and max[width:520 height:410] image.');
					return false;
				}
				return true;
			} else {
				$this->form_validation->set_message('fileCheck_4', 'Please select only jpg/png file.');
				return false;
			}
		} else {
			$this->form_validation->set_message('fileCheck_4', 'Please choose a image to upload.');
			return false;
		}
	}

	/*
     * check exist during validation
     */
	function checkExist($title)
	{
		$categoryId = $this->input->post('category_id');
		$subcategoryId = $this->input->post('subcategory_id');
		$result = $this->product->checkExist($categoryId, $subcategoryId, $title);
		if ($result == 0)
			return true;
		else {
			$this->form_validation->set_message('checkExist', 'Product name must be unique under this categories');
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
		$subcategoryId = $this->input->post('subcategory_id');
		$result = $this->product->checkExistEdit($id, $categoryId, $subcategoryId, $title);
		if ($result == 0)
			return true;
		else {
			$this->form_validation->set_message('checkExistEdit', 'Product name must be unique under this categories');
			return false;
		}
	}
}
