<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends CI_Model {

    public function create_post($data) {
        $this->db->insert('posts', $data);
    }

    public function get_post($id) {
        return $this->db->where('id', $id)
                        ->get('posts')
                        ->row();
    }

    public function update_post($id, $data) {
        $this->db->where('id', $id)->update('posts', $data);
    }

    public function delete_post($id) {
        $this->db->where('id', $id)->delete('posts');
    }

    public function get_posts($limit, $offset) {
        return $this->db->select('posts.*, users.email as username_id, users.id as user_id')
                        ->from('posts')
                        ->join('users', 'posts.user_id = users.id', 'left')
                        ->limit($limit, $offset)
                        ->order_by('posts.modified_at', 'DESC')
                        ->get()
                        ->result(); 
    }

    public function get_post_count() {
        return $this->db->count_all('posts');
    }

}
