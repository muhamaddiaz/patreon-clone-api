<?php

class Post_model extends CI_Model {
  
  public function getAllPosts() {
    return $this->db->get('posts')->result_array();
  }

  public function getUserPosts($id) {
    $this->db->where('id_user', $id);
    return $this->db->get('posts')->result_array();
  }

  public function getPostById($id) {
    $this->db->where('id', $id);
    $postArray = $this->db->get('posts')->result_array();
    return $postArray[0];
  }

  public function createPost($data) {
    return $this->db->insert('posts', $data);
  }

  public function deletePost($id) {
    $this->db->where('id', (int) $id);
    return $this->db->delete('posts');
  }

  public function updatePost($id, $data) {
    $this->db->where('id', (int) $id);
    return $this->db->update('posts', $data);
  }

}