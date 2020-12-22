<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentCtl extends CI_Controller
{
    public function AddPayment($id_assign)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');

        if ($session_data['nama_grup'] != 'editor') {
            redirect('welcome/redirecting');
        }

        $this->load->model(array('payment'));
        $status = 5;
        $tasks = $this->payment->getviewpayments($id_assign, $session_data['id_user']);
        $this->load->view('common/header_editor', array(
            "nama_user" => $session_data['namalengkap'],
            "current_role" => $session_data['nama_grup']
        ));
        $this->load->view('editor/payPayment', array("tasks" => $tasks));
        $this->load->view('common/footer');
    }

    public function payPayment($id_assign = -1, $id_task = -1)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');

        if ($session_data['nama_grup'] != 'editor') {
            redirect('welcome/redirecting');
        }
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model(array('task', 'payment'));
        $this->load->library(array('form_validation'));
        $config['upload_path']          = './storage/bukti';
        $config['allowed_types']        = 'jpg|png|pdf|jpeg';
        $config['max_size']             = 2048;

        $new_name = $_FILES["userfile"]['name'];
        $config['file_name']           = $new_name;

        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            $msg = array('error' => $this->upload->display_errors());
            $this->load->view('common/header_reviewer', array(
                "nama_user" => $session_data['namalengkap'],
                "current_role" => $session_data['nama_grup']
            ));

            $this->load->view('editor/paypayment', $msg);
            $this->load->view('common/footer');
        }
        $data = array('upload_data' => $this->upload->data());


        $status = 5;
        $prices = $this->payment->getAmount($id_task);
        $tasks = $this->payment->getpayments($id_assign, $session_data['id_user'], $status, $new_name, $prices);
        $this->load->view('common/header_editor', array(
            "nama_user" => $session_data['namalengkap'],
            "current_role" => $session_data['nama_grup']
        ));
        $this->load->view('editor/upload_success', array("tasks" => $tasks));
        $this->load->view('common/footer');
    }
}
