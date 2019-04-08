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

  public function decode_get() {
    $cookie = $this->input->cookie('token', true);
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
    $cookie = $this->input->cookie('token', true);
    if($cookie) {
      return $this->response([
        'token' => $cookie 
      ], REST_Controller::HTTP_OK);
    } else {
      return $this->response([
        'token' => 'no token for you!' 
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

  public function register_post() {
    $data = array(
      "full_name" => $this->post('full_name'),
      "email" => $this->post('email'),
      "user_photo" => $this->post('user_photo'),
      "user_background" => $this->post('user_background'),
      "password" => $this->post('password')
    );
    if($this->user->registerUser($data)) {
      $data = array(
        "full_name" => $this->post('full_name'),
        "email" => $this->post('email'),
        "user_photo" => $this->post('user_photo'),
        "user_background" => $this->post('user_background'),
      );
      $token = $this->jwt->generateToken($data);
      $cookie = array(
        'name' => 'token',
        'value' => $token,
        'expire' => 3600
      );
      $this->input->set_cookie($cookie);
      return $this->response([
        "status" => TRUE, 
        "message" => "Created User!"
      ], REST_Controller::HTTP_CREATED);
    } else {
      return $this->response([
        "status" => FALSE, 
        "message" => "User not created!"
      ], REST_Controller::HTTP_BAD_REQUEST);
    }
  }

}