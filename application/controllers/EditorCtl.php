<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditorCtl extends CI_Controller
{

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		//$this->load->view('editor/welcome_page');
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function addTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		//$this->load->view('editor/welcome_page');
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('editor/add_task', array(
			"error" => ""
		));
		$this->load->view('common/footer');
	}

	public function addingtask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->model('task');
		$this->load->model('account');
		//$res = $this->task->insertNewTask($_POST["judul"]);
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('judul', 'Judul', 'trim|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('authors', 'Authors', 'trim|min_length[2]|max_length[50]');


		$res = $this->form_validation->run();
		if ($res === FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('editor/add_task', array("error" => $msg));
			$this->load->view('common/footer');

			//redirect('managemytask/addNewTask/'.$msg);
			return;
		}

		$config['upload_path']          = "../../ereview/storage";
		$config['allowed_types']        = 'doc|docx|pdf';
		$config['max_size']             = 100000;
		$new_name = time() . '_' . $_FILES["userfile"]['name'];
		$config['file_name']           	= $new_name;



		$this->upload->initialize($config);
		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('editor/add_task', $error);
			$this->load->view('common/footer');

			return;
		}
		//$user = $this->account->getIdEditor($session_data['id_user']);
		$error = array('error' => $this->upload->display_errors());
		$data = array('upload_data' => $this->upload->data());

		$id_task  = $this->task->insertNewTask($session_data['id_user'], $new_name);
		$page = $this->input->post("page");
		$price = $page * 10000;
		$this->db->set('page', $page);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');
		$this->db->set('price', $price);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');
		//$this->task->insertprice($price, $page);
		//tampilkan halaman sukses
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('editor/addSuccess',  $price);
		$this->load->view('common/footer');
	}

	public function viewTask()
	{
		$this->load->model('task');
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$tasks = $this->task->getMyTask($session_data['id_user']);

		$this->load->view('common/header_editor', array("nama_user" => $session_data['namalengkap'], "current_role" => $session_data['nama_grup']));
		$this->load->view('editor/ViewTask', array("tasks" => $tasks));

		$this->load->view('common/footer');
	}


	function selectPotentialReviewer($id_task = -1)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		$this->load->model(array('reviewer'));
		$reviewers = $this->reviewer->getAllReviewer();


		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('editor/selectpotential', array("reviewers" => $reviewers, "id_task" => $id_task));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function SelectReviewer($id_task = -1)
	{
		$this->load->model(array('task', 'reviewer'));
		$thetask = $this->task->getTheTask($id_task);
		$reviewers = $this->reviewer->getallreviewer();
		$this->load->view('editor/SelectPotentialReviewer', array('task' => $thetask[0], 'reviewers' => $reviewers));
	}
	public function requestedTask($id_task = -1, $id_reviewer = -1)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		$this->load->model(array('task'));
		$assignments = $this->task->getAssignment($id_task, $id_reviewer);
		if (sizeof(array($assignments)) > 0) {
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('editor/requestingSuccess');

			$this->load->view('common/footer');
		} else {
			$this->load->view('common/header_editor', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup']
			));
			$this->load->view('editor/requestingFailed');

			$this->load->view('common/footer');
		}
	}
	public function listPayment($id, $error = '')
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array('payment'));
		$payment = $this->payment->getPaymentTask($id);

		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->view('editor/ViewPayment', array('payment' => $payment->result(), 'error' => $error));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function uploadBukti($id, $id_task)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$config['upload_path']          = '../../ereview/bukti/editor';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 10000;

		$new_name = time() . "_" . $_FILES["userfile"]['name'];
		$new_name = str_replace(" ", "_", $new_name);;
		$config['file_name'] = $new_name;

		$this->upload->initialize($config);
		if (!$this->upload->do_upload('bukti' . $id)) {
			$error = $this->upload->display_errors();
			echo "<script>alert('" . $error . "')</script>";
			return;
		}

		$data = $this->upload->data();
		$this->Payment->updateStsPayment($id, $data['file_name']);
		$this->Reviewer->updateStsAssignment($id_task);
		$this->load->view('common/header_editor', array("nama_user" => $session_data['namalengkap'], "current_role" => $session_data['nama_grup']));
		$this->load->view('editor/Upload_success', array('error' => ''));
		$this->load->view('common/footer');
		return;
	}
}
