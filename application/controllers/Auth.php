<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function login() {
        $this->load->view('auth/login');
    }

    public function register() {
        $this->load->view('auth/register');
    }

    public function do_register() {
        $email = $this->input->post('email');
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $full_name = $this->input->post('full_name');
        $birth_date = $this->input->post('birth_date');

        if (!$this->User_model->register($email, $password, $full_name, $birth_date)) {
            $this->session->set_flashdata('error', 'Email already exists. Please choose another one.');
            redirect('auth/register'); 
        }

        redirect('auth/login');
    }

    public function do_login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->User_model->get_user($email);

        if ($user && password_verify($password, $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            redirect('posts');
        } else {
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}
