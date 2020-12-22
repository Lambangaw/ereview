<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageAssignedTask extends CI_Controller
{

	public function index()
	{
		echo '<h1>hello </h1>';
		//$this->load->view('welcome_message');
	}
	public function rejectTask()
	{
		$this->load->model('Task');
		$this->load->view('reviewer/RejectTask');
	}
	public function acceptTask()
	{
		$this->load->model('Task');
		$this->load->view('reviewer/AcceptTask');
	}
	public function submitReview()
	{
		$this->load->model('Task');
		$this->load->view('reviewer/SubmitReview');
	}
	public function deductFunds()
	{
		$this->load->model('payment');
		$this->load->view('reviewer/DeductFunds');
	}
}
