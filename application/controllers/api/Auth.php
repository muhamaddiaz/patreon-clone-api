<?php 
require APPPATH . '/libraries/REST_Controller.php';

require APPPATH . '/libraries/ImplementJWT.php';

use \Restserver\Libraries\REST_Controller;

class Auth extends REST_Controller {
  
  function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
    $this->jwt = new ImplementJWT();
    $this->load->helper('cookie');
    $this->load->model('User_model', 'user');
  }

  public function decode_post() {
    $cookie = $this->post('token');
    $decoded = $this->jwt->DecodeToken($cookie);
    if($cookie) {
      return $this->response([
        'status' => TRUE,
        'message' => $decoded
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        'status' => FALSE,
        'message' => 'token has not set!'
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function login_post() {
    $username = $this->post('username');
    $password = $this->post('password');
    if($this->user->loginUser($username, $password)) {
      $user = $this->user->getUserByUsername($username);
      $token = [
        'full_name' => $user['full_name'],
        'username' => $user['username'],
        'email' => $user['email'],
        'user_photo' => $user['user_photo'],
        'user_background' => $user['user_background']
      ];
      return $this->response([
        'status' => TRUE,
        'message' => [
          'token' => $this->jwt->GenerateToken($token)
        ]
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        'status' => FALSE,
        'error' => 'Invalid login credential',
        'message' => [
          'token' => null
        ]
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function register_post() {
    $data = array(
      "full_name" => $this->post('full_name'),
      "username" => $this->post('username'),
      "email" => $this->post('email'),
      "user_photo" => $this->post('user_photo'),
      "user_background" => $this->post('user_background'),
      "password" => password_hash($this->post('password'), PASSWORD_DEFAULT)
    );
    if($this->user->registerUser($data)) {
      $username = $this->post('username');
      $user = $this->user->getUserByUsername($username);
      $data = [
        'full_name' => $user['full_name'],
        'username' => $user['username'],
        'email' => $user['email'],
        'user_photo' => $user['user_photo'],
        'user_background' => $user['user_background']
      ];
      $token = $this->jwt->GenerateToken($data);
      return $this->response([
        "status" => TRUE, 
        "message" => [
          "token" => $token
        ]
      ], REST_Controller::HTTP_CREATED);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "User not created!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}