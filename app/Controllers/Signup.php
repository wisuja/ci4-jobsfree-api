<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Signup extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
    }

    //Mendaftar userbaru
    //http://localhost:8080/signup
    //method: POST
    public function create()
    {
        helper(['form']);

        $rules = [
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_no' => 'required',
            'idcard_no' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'role_id' =>  $this->request->getVar('role_id'),
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'image' => $this->request->getVar('image'),
                'phone_no' => $this->request->getVar('phone_no'),
                'idcard_no' => $this->request->getVar('idcard_no'),
                'creates_on' => date("Y-m-d H:i:s"),
            ];
            $insert = $this->model->insert($data);
            $data['id'] = $insert;
            $data['status'] = 200;
            return $this->respondCreated($data);
        }
    }
}