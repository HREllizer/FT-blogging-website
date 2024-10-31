<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Post_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->database();
    }

    public function index() {
        $this->is_logged_in();

        $limit = 3; //Limit per page
        $current_page = $this->input->get('page') ? (int)$this->input->get('page') : 1;
        $offset = ($current_page - 1) * $limit;
        $data['posts'] = $this->Post_model->get_posts($limit, $offset);
        $total_posts = $this->Post_model->get_post_count();
        $data['total_pages'] = ceil($total_posts / $limit);
        $data['current_page'] = $current_page;
        $this->load->view('posts/index', $data);
    }

    public function create() {
        $this->is_logged_in();
        $this->load->view('posts/create');
    }

    public function store() {
        $data = array(
            'user_id' => $this->session->userdata('user_id'),
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'content' => $this->input->post('content')
        );
        $this->Post_model->create_post($data);
        redirect('posts');
    }

    public function edit($id) {
        $this->is_logged_in();
        $data['post'] = $this->Post_model->get_post($id);
        $this->load->view('posts/edit', $data);
    }

    public function update($id) {
        $data = array(
            'title' => $this->input->post('title'),
            'description' => $this->input->post('description'),
            'content' => $this->input->post('content')
        );
        $this->Post_model->update_post($id, $data);
        redirect('posts');
    }

    public function delete($id) {
        $this->Post_model->delete_post($id);
        redirect('posts');
    }

    private function is_logged_in() {
        if (!$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }
}
