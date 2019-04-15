<?php 
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/ImplementJWT.php';

use \Restserver\Libraries\REST_Controller;

class Comments extends REST_Controller {
  
  function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
      die();
    }
    $this->objJWT = new ImplementJWT();
    $this->load->model('Post_model', 'post');
    $this->load->model('User_model', 'user');
    $this->load->model('Comment_model', 'comment');
  }

  public function index_get() {
    $id = $this->get('post');
    $post = $this->post->getPostById($id);
    if($post) {
      $comments = $this->comment->getPostComments($post['id']);
      if($comments) {
        return $this->response([
          "status" => TRUE, 
          "message" => $comments
        ], REST_Controller::HTTP_OK);
      } else {
        return $this->response([
          "status" => FALSE, 
          "message" => "Comments not found!"
        ], REST_Controller::HTTP_BAD_REQUEST);
      }
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "Posts not found!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_post() {
    $data = [
      "id_post" => $this->post('id_post'),
      "id_user" => $this->post('id_user'),
      "comment_body" => $this->post('comment_body')
    ];
    if($comment = $this->comment->createComment($data)) {
      return $this->response([
        "status" => TRUE, 
        "message" => $comment
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "Comment not created!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_delete($id) {
    if($this->comment->deleteComment($id)) {
      return $this->response([
        "status" => TRUE, 
        "message" => "Comment deleted!"
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "Comment not deleted!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}