<?php 
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/ImplementJWT.php';

use \Restserver\Libraries\REST_Controller;

class Users extends REST_Controller {
  
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
    $this->load->model('User_model', 'user');
  }

  public function index_get($id = null) {
    if($id) {
      $user = $this->user->getUser($id);
      if($user) {
        return $this->response([
          "status" => TRUE, 
          "message" => $user
        ], REST_Controller::HTTP_OK);
      } else {
        return $this->response([
          "status" => FALSE, 
          "message" => "User not found!"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    } else {
      $users = $this->user->getAllUsers();
      if($users) {
        return $this->response([
          "status" => TRUE, 
          "message" => $users
        ], REST_Controller::HTTP_OK);
      } else {
        return $this->response([
          "status" => FALSE, 
          "message" => "Users not found!"
        ], REST_Controller::HTTP_NOT_FOUND);
      }
    }
    
  }

  public function show_get($id) {
    
  }
}