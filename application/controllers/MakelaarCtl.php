<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MakelaarCtl extends CI_Controller
{

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('welcome/redirecting');
		}
		$this->load->view('common/header_editor', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('common/header_makelaar', array("nama_user" => $session_data['namalengkap']));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function viewNewTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 0;
		$tasks = $this->task->getviewmakelar($status);

		$this->load->view('common/header_makelaar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewNewTask', array("tasks" => $tasks));
		$this->load->view('common/footer');
	}

	public function viewOngoingTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 2;
		$tasks = $this->task->getviewmakelar($status);

		$this->load->view('common/header_makelaar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewOngoingTask', array("tasks" => $tasks));
		$this->load->view('common/footer');
	}

	public function viewCompletedTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 4;
		$tasks = $this->task->getviewcompleted($status);

		$this->load->view('common/header_makelaar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewCompletedTask', array("tasks" => $tasks));
		$this->load->view('common/footer');
	}
	public function confirmPayment($id_task, $id_assign, $id_user)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("Payment"));
		$saldo = $this->Payment->getSaldo($id_user);
		$amounttambah = $this->Payment->getAmountComplete($id_assign);
		$amount = $saldo + $amounttambah;
		$status = 6;
		$tasks = $this->Payment->confirmPayment($status, $id_user, $amount, $id_assign);

		$this->load->view('common/header_makelar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/confirmSuccess', array("tasks" => $tasks));
		$this->load->view('common/footer');
	}
	function viewPaidTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('welcome/redirecting');
		}

		$this->load->model(array("task"));
		$status = 5;
		$tasks = $this->task->getPaidTask($status);

		$this->load->view('common/header_makelaar', array(
			"nama_user" => $session_data['namalengkap'],
			"current_role" => $session_data['nama_grup']
		));

		$this->load->view('makelaar/viewPaidTask', array("tasks" => $tasks));
		$this->load->view('common/footer');
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
		redirect('makelaarCtl/viewPaidTask');
	}

	function accepted($id_task = -1, $id_user = -1, $id_assignment = -1)
	{
		$status = 6;
		$this->db->set('status', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('assignment');
		$this->db->set('sts_task', $status);
		$this->db->where('id_task', $id_task);
		$this->db->update('task');

		$this->load->model(array('payment'));
		$saldo = $this->payment->getSaldo($id_user);
		$amounttambah = $this->payment->getAmountComplete($id_assignment);
		$amount = $saldo + $amounttambah;
		$tasks = $this->payment->confirmPayment($status, $id_user, $amount, $id_assignment);

		redirect('makelaarCtl/viewPaidTask');
	}
}
