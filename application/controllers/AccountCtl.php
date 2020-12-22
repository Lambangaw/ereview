<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountCtl extends CI_Controller
{
    public function index()
    {
        echo '<h1>hello </h1>';
        //$this->load->view('welcome_message');
    }
    public function login($pesan = '')
    {
        $this->load->view('login', array('msg' => $pesan));
        $this->load->helper('form');
    }
    public function createAccount($pesan = '')
    {
        $this->load->view('create_account', array('msg' => $pesan));
        $this->load->helper('form');
    }
    public function creatingAccount()
    {
        $this->load->helper('url', 'security');
        $this->load->model('account');
        //$res = $this->task->insertNewTask($_POST["judul"]);
        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('nama', 'Nama', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('sandi', 'Password', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[256]');



        $res = $this->form_validation->run();
        if ($res === FALSE) {
            $msg = validation_errors();
            $this->load->view('createaccount', array('msg' => $msg));

            //redirect('managemytask/addNewTask/'.$msg);
            return FALSE;
        }
        $id_user = $this->account->insertNewUser();
        redirect('accountctl/checkinglogin/' . $id_user);
    }
    public function checkingLogin()
    {
        $this->load->helper('security', 'url');
        $this->load->model('account');
        //$res = $this->task->insertNewTask($_POST["judul"]);
        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('sandi', 'Password', 'trim|min_length[2]|max_length[128]');



        $res = $this->form_validation->run();
        if ($res == FALSE) {
            $msg = validation_errors();
            $this->load->view('common/header');
            $this->load->view('login', $msg);
            $this->load->view('common/footer');

            return FALSE;
        }
        $user = $this->account->getIDUser();
        $id_user = $this->account->getIDUser();


        if (sizeof($user) <= 0) {
            $msg = "Username/Password is incorrect!";
            $this->load->view('common/header');
            $this->load->view('login', $msg);
            $this->load->view('common/footer');
        } else {

            $sess_array = array();

            $sess_array = array(
                'id_user' => $user[0]['id_user'],
                'namalengkap' => $user[0]['nama'],
                'username' => $user[0]['username'],
                'nama_grup' => $user[0]['nama_grup'],
                'id_grup' => $user[0]['id_grup'],
                'password' => $user[0]['pass']
            );
            $this->session->set_userdata('logged_in', $sess_array);


            if ($user[0]['id_grup']  == 1) {
                //welcome page editor
                redirect('editorctl');
            } else if ($user[0]['id_grup']  == 2) {
                //welcome page reviewer
                redirect('reviewerctl');
            } else if ($user[0]['id_grup']  == 3) {
                //welcome page makelaar
                redirect('makelaarctl');
            }
        }


        // redirect('accountctl/login/'. $id_user);

    }

    public function logout()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index.php');
        }
        $session_data = $this->session->userdata('logged_in');
        $this->session->unset_userdata('logged_in');
        session_destroy();

        redirect("welcome");
    }

    public function signingUp()
    {
        $this->load->helper(array('form', 'url', 'security'));
        $this->load->model('account');
        //$res = $this->task->insertNewTask($_POST["judul"]);
        $this->load->library(array('form_validation'));
        $this->form_validation->set_rules('nama', 'Nama', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('username', 'Username', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('sandi', 'Password', 'trim|min_length[2]|max_length[128]');
        $this->form_validation->set_rules('email', 'Email', 'trim|min_length[2]|max_length[256]');

        $res = $this->form_validation->run();
        if ($res == FALSE) {
            $msg = validation_errors();
            $this->load->view('common/header');
            $this->load->view('signup', $msg);
            $this->load->view('common/footer');
            //redirect('managemytask/addNewTask/'.$msg);
            return FALSE;
        }

        $config['upload_path']          = "./photos/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 50;
        $config['max_width']            = 150;
        $config['max_height']           = 200;
        //$new_name = time() . $_FILES["userfiles"]['name'];
        $name = $_FILES["userfile"]['name'];
        $config['file_name']           = $name;
        $this->upload->initialize($config);
        // $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('common/header');
            $this->load->view('signup', $error);
            $this->load->view('common/footer');

            return;
        }
        $data =  $this->upload->data();

        $id_user = $this->account->insertNewUser($data['file_name']);
        $this->load->view('common/header');
        $this->load->view('signup_success');
        $this->load->view('common/footer');

        return;
    }

    public function profile()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/index.php');
        }
        $session_data = $this->session->userdata('logged_in');

        $this->load->model(array('account', 'task'));

        $user = $this->account->getUser($session_data['id_user']);
        $roles = $this->account->getRoles($session_data['id_user']);
        $balance = $this->task->getReviewerBalance($session_data['id_user']);
        $this->load->view('common/header_' . $session_data['nama_grup'], array(
            "nama_user" => $session_data['namalengkap'],
            "current_role" => $session_data['nama_grup']
            // "saldo" => $balance[0]['saldo']
        ));
        $this->load->view('profile', array(
            "error" => "",
            "user" => $user[0],
            "roles" => $roles
        ));
        $this->load->view('common/footer');
    }

    public function changerole()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/login');
        }
        $session_data = $this->session->userdata('logged_in');

        $this->load->helper(array('form', 'url'));

        $this->load->model("account");
        $user = $this->account->getUser($session_data['id_user']);
        $roles = $this->account->getRoles($session_data['id_user']);


        $this->load->view('common/header_' . $session_data['nama_grup'], array(
            "nama_user" => $session_data['namalengkap'],
            "current_role" => $session_data['nama_grup'],
        ));
        $this->load->view('changerole', array("roles" => $roles, "current_role" => $session_data['nama_grup']));

        $this->load->view('common/footer');
    }

    public function changingRole()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('welcome/login');
        }
        $session_data = $this->session->userdata('logged_in');

        $this->load->helper(array('form', 'url'));

        $this->load->model("account");
        $user = $this->account->getUser($session_data['id_user']);
        $roles = $this->account->getRoles($session_data['id_user']);


        if ($session_data['id_grup'] == '1') {

            $sess_array = array(
                'id_user' => $user[0]['id_user'],
                'namalengkap' => $user[0]['nama'],
                'username' => $user[0]['username'],
                'nama_grup' => 'reviewer',
                'id_grup' => '2',
                'password' => $user[0]['pass']
            );
            $this->session->set_userdata('logged_in', $sess_array);
            redirect('reviewerctl');
        } elseif ($session_data['id_grup'] == '2') {

            $sess_array = array(
                'id_user' => $user[0]['id_user'],
                'namalengkap' => $user[0]['nama'],
                'username' => $user[0]['username'],
                'nama_grup' => 'editor',
                'id_grup' => '1',
                'password' => $user[0]['pass']
            );
            $this->session->set_userdata('logged_in', $sess_array);
            redirect('editorctl');
        }
    }







    public function editProfile()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('Welcome/login');
        }
        $session_data = $this->session->userdata('logged_in');
        $this->load->library(array('form_validation'));
        $this->load->helper(array('url', 'form', 'security'));
        $this->load->model("account");
        $user = $this->account->getUser($session_data['id_user']);
        $roles = $this->account->getRoles($session_data['id_user']);
        $this->load->view(
            'common/header_' . $session_data['nama_grup'],
            array(
                "nama_user" => $session_data['namalengkap'],
                "current_role" => $session_data['nama_grup']
            )
        );
        $this->load->view('editprofile', array(
            "error" => "",
            "user" => $user[0],
            "roles" => $roles
        ));
        $this->load->view('common/footer');
    }

    public function editingProfile()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('Welcome/index');
        }
        $session_data = $this->session->userdata('logged_in');



        $this->load->helper(array('form', 'url', 'security'));
        $this->load->library(array('form_validation'));

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        if ($this->form_validation->run() == false) {
            redirect('AccountCtl/profile');
        } else {
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $this->load->helper(array('form', 'url'));
            $upload_foto = $_FILES['photo']['name'];

            if ($upload_foto) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './photos/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('photo')) {

                    $old_photo = $data['username']['photo'];
                    if ($old_photo != 'default.jpg') {
                        unlink(FCPATH . 'photos/' . $old_photo);
                    }
                    $new_photo = $this->upload->data('file_name');
                    $this->db->set('photo', $new_photo);
                } else {

                    redirect('AccountCtl/profile');
                }
            }
        }
        $this->db->set('nama', $nama);
        $this->db->where('id_user', $session_data['id_user']);
        $this->db->update('users');
        $this->db->set('username', $username);
        $this->db->where('id_user', $session_data['id_user']);
        $this->db->update('users');
        $this->db->set('email', $email);
        $this->db->where('id_user', $session_data['id_user']);
        $this->db->update('users');
        redirect('AccountCtl/profile');
    }
}
