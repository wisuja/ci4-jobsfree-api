<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    //get data seluruh user
    //http://localhost/users/
    //method: GET
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    //get data detail user per ID
    //http://localhost:8080/user/$id
    //method: GET
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    //Edit data user
    //http://localhost:8080/user/$id
    //method: PUT
    public function update($id = null)
    {
        helper(['form']);

        $rules = [
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
                'id' => $id,
                'role_id' =>  $this->request->getVar('role_id'),
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'password' => $this->request->getVar('password'),
                'image' => $this->request->getVar('image'),
                'phone_no' => $this->request->getVar('phone_no'),
                'idcard_no' => $this->request->getVar('idcard_no'),
                'update_on' => date("Y-m-d H:i:s"),
            ];

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    // update password
    // http://localhost:8080/user/update_password/$id
    // methoed: PUT
    public function update_password($id = null)
    {
        helper(['form']);

        $rules = [
            'password' => 'required',
            'new_password' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $this->model->cek_pswd($this->request->getVar('password'));
        }
    }
}