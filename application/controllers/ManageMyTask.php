<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageMyTask extends CI_Controller
{

	public function index()
	{
		echo '<h1>hello </h1>';
		//$this->load->view('welcome_message');
	}
	public function addNewTask($pesan = '')
	{
		$this->load->helper('form');
		$this->load->view('editor/AddNewTask', array('msg' => $pesan));
	}
	public function addingNewTask()
	{
		$this->load->helper('url');
		$this->load->model('task');
		//$res = $this->task->insertNewTask($_POST["judul"]);
		$this->load->library(array('form_validation'));
		$this->form_validation->set_rules('judul', 'Judul', 'trim|min_length[2]|max_length[250]');
		$this->form_validation->set_rules('keywords', 'Kata Kunci', 'trim|min_length[2]|max_length[50]');


		$res = $this->form_validation->run();
		if ($res === FALSE) {
			$msg = validation_errors();
			$this->load->view('editor/AddNewTask/', array('msg' => $msg));

			//redirect('managemytask/addNewTask/'.$msg);
			return FALSE;
		}
		//echo ": new task is addded";
		$id_task = $this->task->insertNewTask();
		redirect('managemytask/SelectReviewer/' . $id_task);
	}
	public function SelectReviewer($id_task = -1)
	{
		$this->load->model(array('task', 'reviewer'));
		$thetask = $this->task->getTheTask($id_task);
		$reviewers = $this->reviewer->getallreviewer();
		$this->load->view('editor/SelectPotentialReviewer', array('task' => $thetask[0], 'reviewers' => $reviewers));
	}
	public function commitPayment()
	{
		$this->load->model('payment');
		$this->load->view('editor/CommitPayment');
	}
	public function confirmTask()
	{
		$this->load->model('Task');
		$this->load->view('editor/ConfirmTask');
	}
}
