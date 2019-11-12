<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Mahasiswa extends REST_Controller {

    // use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }

    public function __construct(){
        parent::__construct();
        $this->load->model('Mahasiswa_model');
    }


    public function index_get(){

        $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
        var_dump($mahasiswa);

    }
}


?>