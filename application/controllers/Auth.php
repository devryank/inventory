<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user');
    }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Login';
            $this->load->view('partials/_header', $data);
            $this->load->view('login');        
        }else{
            $this->_login();
        }
    }

    public function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tbl_user', ['email' => $email])->row_array();

        if($user['is_active'] == 1)
        {
            // cek password
                if(password_verify($password, $user['password']))
                {
                    $data = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong email or password</div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akun belum diaktifkan administrator</div>');
                redirect('auth');
            }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if($this->form_validation->run() == FALSE)
        {
            $data['title'] = 'Registration';
            $this->load->view('partials/_header', $data);
            $this->load->view('registration');        
        }else{
            $this->m_user->registration();
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/index');
    }
}
