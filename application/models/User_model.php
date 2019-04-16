<?php


class User_model extends CI_Model {
  
  public function getAllUsers() {
    return $this->db->get('users')->result_array();
  }

  public function getUserById($id) {
    $this->db->where('id', (int) $id);
    return $this->db->get('users')->result_array();
  }

  public function getUserByUsername($username) {
    $this->db->where('username', strtolower($username));
    $user = $this->db->get('users')->result_array();
    if($user) {
      return $user[0];
    }
    return null;
  }

  public function getUserByEmail($email) {
    $this->db->where('email', strtolower($email));
    $user = $this->db->get('users')->result_array();
    if($user) {
      return $user[0];
    }
    return null;
  }

  public function registerUser($data) {
    $user = $this->getUserByUsername($data['username']);
    $email = $this->getUserByEmail($data['email']);
    if($user || $email) {
      return false;
    }
    return $this->db->insert('users', $data);
  }

  public function loginUser($username, $password) {
    $this->db->where('username', $username);
    $user = $this->db->get('users')->result_array()[0];
    if($user && password_verify($password, $user['password'])) {
      return true;
    } else {
      return false;
    }
  }

  public function updateUser($username, $data) {
    $user = $this->getUserByUsername($username);
    if($user) {
      $updated = [
        "full_name" => $user['full_name'],
        "username" => $data['username'],
        "email" => $user['email'],
        "creating" => $data['creating'],
        "password" => $user['password']
      ];
      $this->db->where('id', (int) $user['id']);
      return $this->db->update('users', $updated);
    } else {
      return false;
    }
  }

}