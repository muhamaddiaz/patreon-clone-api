<?php 
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/ImplementJWT.php';

use \Restserver\Libraries\REST_Controller;

class Posts extends REST_Controller {
  
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
  }

  // Mendapatkan semua posts dan mendapatkan post berdasarkan username
  public function index_get() {
    $username = $this->get('username');
    if($username) {
      $user = $this->user->getUserByUsername($username);
      if($user) {
        $posts = $this->post->getUserPosts($user['id']);
        if($posts) {
          return $this->response([
            "status" => TRUE, 
            "message" => $posts
          ], REST_Controller::HTTP_OK);
        } else {
          return $this->response([
            "status" => FALSE, 
            "message" => "Posts not found!"
          ], REST_Controller::HTTP_NOT_FOUND);
        }
      } else {
        return $this->response([
          "status" => FALSE, 
          "message" => "User not found!"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $posts = $this->post->getAllPosts();
      if($posts) {
        return $this->response([
          "status" => TRUE,
          "message" => $posts
        ], REST_Controller::HTTP_OK);
      } else {
        return $this->response([
          "status" => FALSE, 
          "message" => "Posts not found!"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    }
  }

  // Membuat post baru
  public function index_post() {
    $data = [
      "id_user" => $this->post('id_user'),
      "post_title" => $this->post('post_title'),
      "post_body" => $this->post('post_body')
    ];
    if($post = $this->post->createPost($data)) {
      return $this->response([
        "status" => TRUE,
        "message" => $post
      ], REST_Controller::HTTP_CREATED);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "Post not created!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  // Menghapus post
  public function index_delete($id) {
    if($this->post->deletePost($id)) {
      return $this->response([
        "status" => TRUE, 
        "message" => "post has been deleted successfully!"
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "post has not deleted!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function index_put($id) {
    $data = [
      "post_title" => $this->put('post_title'),
      "post_body" => $this->put('post_body')
    ];
    if($post = $this->post->updatePost($id, $data)) {
      return $this->response([
        "status" => TRUE,
        "message" => $post
      ], REST_Controller::HTTP_CREATED);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "Post not updated!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}