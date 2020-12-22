<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageAllTask extends CI_Controller
{

	public function index()
	{
		echo '<h1>hello </h1>';
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
		$this->load->view('reviewer/SubmiitReview');
	}
	public function deductFunds()
	{
		$this->load->model('payment');
		$this->load->view('reviewer/DeductFunds');
	}
}
