<?php

class User_model extends CI_Model {
  
  public function getAllUsers() {
    return $this->db->get('users')->result_array();
  }

  public function getUser($id) {
    $this->db->where('id', (int) $id);
    return $this->db->get('users')->result_array();
  }

  public function registerUser($data) {
    return $this->db->insert('users', $data);
  }

}