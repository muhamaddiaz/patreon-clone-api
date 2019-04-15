<?php

class Comment_model extends CI_Model {
  
  public function getPostComments($id) {
    $this->db->where('id_post', (int) $id);
    return $this->db->get('comments')->result_array();
  }

  public function createComment($data) {
    $this->db->insert('comments', $data);
    return $this->db->insert_id();
  }

  public function deleteComment($id) {
      $this->db->where('id', (int) $id);
      return $this->db->delete('comments');
  }

}