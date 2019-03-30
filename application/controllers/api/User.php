<?php 
require APPPATH . '/libraries/REST_Controller.php';

class User extends \Restserver\Libraries\REST_Controller {
  
  function __construct() {
    parent::__construct();
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == "OPTIONS") {
        die();
    }
  }

  function index_get() {
    $response['status']=200;
    $response['error']=false;
    $response['user']['username']='muhamaddiaz';
    $response['user']['email']='muhamaddiaz@gmail.com';
    $response['user']['detail']['full_name']='Muhamad Diaz R';
    $response['user']['detail']['position']='Developer';
    $response['user']['detail']['specialize']='Android,IOS,WEB,Desktop';

    $this->response($response);
  }

  function index_put() {
    $this->response("put request");
  }

}