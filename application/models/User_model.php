<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function register($email, $password, $full_name, $birth_date) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return false;
        }
        $data = array(
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'birth_date' => $birth_date,
        );

        return $this->db->insert('users', $data);
    }

    public function get_user($email) {
        return $this->db->where('email', $email)->get('users')->row();
    }
}
