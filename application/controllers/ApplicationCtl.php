<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApplicationCtl extends CI_Controller
{

    public function download($id_task = 0)
    {
        $this->load->helper(array('url', 'download'));
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');

        $this->load->model(array('task'));
        $task = $this->task->getTheTask($id_task);
        if (sizeof($task) <= 0) {
            echo "Failed";
            return;
        }
        force_download('../../ereview/storage/' . $task[0]['file_location'], NULL);
        echo "succes" . ('../../ereview/storage/' . $task[0]['file_location']);
        return;
    }
    function buktiDownload($id_assignment = -1)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');
        $this->load->helper('download');
        $this->load->model(array('payment', 'task'));
        $bukti = $this->payment->getBukti($id_assignment);

        $task = $this->task->getTheBukti($id_assignment);
        if (($bukti->bukti) <= 0) {
            echo "failed";
            return;
        }

        echo var_dump($bukti);
        echo var_dump($task);
        force_download('./storage/bukti/' . $task, NULL);
        return;
    }

    function assignmentDownload($id_assignment = -1)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');
        $this->load->helper('download');
        $this->load->model(array("payment"));
        $assignment = $this->payment->getTheAssignmentFile($id_assignment);
        if (sizeof($assignment) <= 0) {
            echo "failed";
            return;
        }
        force_download('../../ereview/storage/complete/' . $assignment[0]['file_location'], NULL);
        return;
    }

    function editorassignmentDownload($id_task = -1)
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');
        $this->load->helper('download');
        $this->load->model(array("payment"));
        $assignment = $this->payment->editorgetTheAssignmentFile($id_task);

        if (sizeof($assignment) <= 0) {
            echo "failed";
            return;
        }
        force_download('../../ereview/storage/complete/' . $assignment[0]['file_location'], NULL);
        return;
    }
}
