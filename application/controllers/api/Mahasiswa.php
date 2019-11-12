<?php

use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';


class Mahasiswa extends CI_Controller {

    use REST_Controller { REST_Controller::__construct as private __resTraitConstruct; }

    public function __construct(){
        parent::__construct();
        $this->__resTraitConstruct();
        $this->load->model('Mahasiswa_model');
    }


    public function index_get(){

        $id = $this->get('id');
        if ($id === null){
            $mahasiswa = $this->Mahasiswa_model->getMahasiswa();
        } else {
            $mahasiswa = $this->Mahasiswa_model->getMahasiswa($id);
        }

        // var_dump($mahasiswa);
         // Set the response and exit
         $this->response([
            'status' => true,
            'message' => $mahasiswa
        ], 200); // NOT_FOUND (404) being the HTTP response code

    }

    public function index_delete(){

       $id = $this->delete('id');

       if($id === null){
        $this->response([
            'status' => false,
            'message' => 'Masukan id yang akan dihapus'
        ], 400); 
       } else {
           if ($this->Mahasiswa_model->deleteMahasiswa($id) > 0){
            $this->response([
                'status' => true,
                'id'=> $id,
                'message' => 'Berhasil Menghapus'
            ], 204);            
        } else {
            $this->response([
                'status' => false,
                'message' => 'gagal menghapus'
            ], 404);
        }

       }

    }

    public function index_post(){

        $data = [
            'nrp'=> $this->post('nrp'),
            'nama'=> $this->post('nama'),
            'email'=> $this->post('email'),
            'jurusan'=> $this->post('jurusan'),
        ];

        if($this->Mahasiswa_model->createMahasiswa($data) > 0){
            $this->response([
                'status' => true,
                // 'data' => $data,
                'message' => 'Mahasiswa baru berhasil ditambahkan'
            ], 201); 
        } else {
            if($data === null){
                $this->response([
                    'status' => false,
                    'message' => 'Masukan Data'
                ], 400);
            } else {
            $this->response([
                'status' => false,
                'message' => 'Kayaknya error'
            ], 400);
        }
        }

    }

    public function index_put(){
        $id = $this->put('id');
        $data = [
            'nrp'=> $this->put('nrp'),
            'nama'=> $this->put('nama'),
            'email'=> $this->put('email'),
            'jurusan'=> $this->put('jurusan'),
        ];

        if($this->Mahasiswa_model->updateMahasiswa($data, $id) > 0){
            $this->response([
                'status' => true,
                // 'data' => $data,
                'message' => 'Mahasiswa baru berhasil diupdate'
            ], 201); 
        } else {
            if($data === null){
                $this->response([
                    'status' => false,
                    'message' => 'Masukan Data'
                ], 400);
            } else {
            $this->response([
                'status' => false,
                'message' => 'Data Tidak Berubah'
            ], 204);
        }
        }

    }



}


?>