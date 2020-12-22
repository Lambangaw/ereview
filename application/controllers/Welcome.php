<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function login($msg = "")
	{
		$this->load->view('common/header');
		$this->load->view('login', $msg);
		$this->load->view('common/footer');
	}

	public function checkinglogin()
	{
		echo "username" . $this->input->post('username');
		echo "checking login check";
	}

	public function redirecting()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index.php');
		}
		$session_data = $this->session->userdata('logged_in');

		//$user = $this->account->getIDUser();

		if ($user[0]['id_grup']  == 1) {
			//welcome page editor
			redirect('editorctl');
		} else if ($user[0]['id_grup']  == 2) {
			//welcome page reviewer
			redirect('reviewerctl');
		} else if ($user[0]['id_grup']  == 3) {
			//welcome page makelaar
			redirect('makelaarctl');
		} else {
			redirect('welcome');
		}
	}

	public function signup()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->view('common/header');
		$this->load->view('signup', array("error" => ''));
		$this->load->view('common/footer');
		return;
	}
}
