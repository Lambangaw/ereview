<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewerCtl extends CI_Controller
{

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));
		$this->load->model('reviewer');
		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function viewAssignment()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->model(array('reviewer'));
		$assignments = $this->reviewer->getRequested($session_data['id_user']);
		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('reviewer/viewAssignment', array("assignments" => $assignments));
		$this->load->view('common/footer');
	}
	function accepted($id_task = -1)
	{
		$this->load->model("task");
		$date = date("Y-m-d H:i:s");
		$page = $this->task->getTaskPage($id_task);
		$deadline = date('Y-m-d', strtotime($date . '+' . $page->page . ' days'));
		$this->db->set('tgl_deadline', $deadline);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');

		$status = 2;
		$this->db->set('status', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');

		$this->db->set('sts_task', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');
		redirect('reviewerCtl/viewAssignment');
	}

	function rejected($id_task = -1)
	{

		$status = 3;
		$this->db->set('status', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');
		$this->db->set('sts_task', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');
		redirect('reviewerCtl/viewAssignment');
	}

	public function viewAcceptedAssignment($id_task = -1)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->model(array('task', 'reviewer'));
		$assignments = $this->reviewer->getAccepted($session_data['id_user'], $id_task);

		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('reviewer/viewAcceptedAssignment', array("assignments" => $assignments));

		$this->load->view('common/footer');
	}
	public function viewHistoryAssignment($id_task = -1)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$this->load->model(array('task', 'reviewer'));
		$assignments = $this->reviewer->gethistory($session_data['id_user'], $id_task);

		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('reviewer/viewHistoryAssignment', array("assignments" => $assignments));

		$this->load->view('common/footer');
	}
	public function completeReviewTask($id_task)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}
		$this->load->helper('form');
		$this->load->model(array('reviewer', 'task'));
		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$namareviewer = $session_data['namalengkap'];
		$this->load->view('reviewer/completeTask', array(
			"namareviewer" => $namareviewer,
			"id_task" => $id_task
		));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function completingReviewTask($id_task)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->helper(array('form', 'url', 'security'));
		$this->load->model('task');
		$this->load->library(array('form_validation'));

		$config['upload_path']          = '../../ereview/storage/complete';
		$config['allowed_types']        = 'doc|docx|pdf';
		$config['max_size']             = 10000;


		$new_name = time() . "_" . $_FILES["userfile"]['name'];

		$config['file_name'] = $new_name;
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('userfile')) {
			$namareviewer = $session_data['namalengkap'];
			$error = array('error' => $this->upload->display_errors());
			$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $balance[0]['saldo']
			));
			//$this->load->view('common/topmenu');
			$this->load->view(
				'reviewer/completeTask',
				array(
					"namareviewer" => $namareviewer,
					"id_task" => $id_task
				),
				$error
			);
			$this->load->view('common/footer');
			return;
		}

		$this->load->model(array('task', 'reviewer'));
		$status = 4;

		$this->db->set('sts_task', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');

		$this->db->set('status', $status);
		$this->db->set('file_location', $new_name);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');

		$assignments = $this->reviewer->getUploadedAssignment($session_data['id_user']);
		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('reviewer/viewAcceptedAssignment', array("assignments" => $assignments));
		//$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function deductFund()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
			return;
		}
		$session_data = $this->session->userdata('logged_in');
		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array('reviewer', 'task'));

		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$this->load->view('common/header_reviewer', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup'],
			"saldo" => $balance[0]['saldo']
		));
		$this->load->view('reviewer/deductfunds', array(
			"saldo" => $balance,
			"username" => $session_data['username']
		));
		$this->load->view('common/footer');
	}
	public function deductFunding()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
			return;
		}
		$session_data = $this->session->userdata('logged_in');
		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}
		$this->load->model(array('task', 'reviewer'));
		$this->load->helper(array('form', 'url', 'security'));
		$this->load->library(array('form_validation'));
		$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
		$account = $this->reviewer->getReviewerAccount($session_data['id_user']);
		$this->form_validation->set_rules(
			'potongansaldo',
			'Deduct Fund Credits',
			'trim|min_length[2]|max_length[128]|xss_clean'
		);

		$potongansaldo = $this->input->post('potongansaldo');
		if ($balance[0]['saldo'] >= $potongansaldo) {
			$jumlahsaldo = $balance[0]['saldo'] - $potongansaldo;

			$this->db->set('saldo', $jumlahsaldo);
			$this->db->where('id_user',  $session_data['id_user']);
			$this->db->update('reviewer');

			$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $balance[0]['saldo']
			));
			$this->load->view('reviewer/deduct_success', array(
				"saldo" => $balance,
				"username" => $session_data['username'],
				"account" => $account
			));
			$this->load->view('common/footer');
		} else {
			$this->load->model(array('reviewer'));
			$balance = $this->reviewer->getReviewerBalance($session_data['id_user']);
			$this->load->view('common/header_reviewer', array(
				"nama_user" => $session_data['namalengkap'],
				"current_role" => $session_data['nama_grup'],
				"saldo" => $balance[0]['saldo']
			));
			$this->load->view('reviewer/deduct_failed', array(
				"saldo" => $balance,
				"username" => $session_data['username'],
				"account" => $account
			));
			$this->load->view('common/footer');
		}
	}
}
