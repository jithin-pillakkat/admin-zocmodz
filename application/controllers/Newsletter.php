<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Newsletter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->controller = strtolower(__CLASS__);		
		$this->load->model('Newsletter_model', 'newsletter');
	}

	public function index()
	{
		$this->layout->template(TEMPLATE_ADMIN)->show("{$this->controller}/{$this->controller}");
	}

	public function destroy()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		} else {
			$id = $this->input->get('id');			
			$destroy = $this->newsletter->destroy($id);
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

			$draw = $_GET['draw'];

			$newsletters = $this->newsletter->getNewsletters($search, $order, $order_column, $order_dir, $start, $length, $draw);
			echo json_encode($newsletters);
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
			$changeStatus = $this->newsletter->update(['newsletter_status' => $statusValue], $id);
			if ($changeStatus) {
				echo json_encode(['status' => $newStatus, 'message' => $message]);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Somthing went wrong']);
			}
		}
	}
	
}
