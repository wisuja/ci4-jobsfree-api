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
            'phone_no' => 'required',
            'idcard_no' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'id' => $id,
                'role_id' =>  $input['role_id'],
                'name' =>  $input['name'],
                'email' =>  $input['email'],
                'phone_no' =>  $input['phone_no'],
                'idcard_no' =>  $input['idcard_no'],
                'update_on' => date("Y-m-d H:i:s"),
            ];

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    // update password
    // http://localhost:8080/user/update_password/$id
    // methoed: POST
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
            $password = $this->request->getVar('password');
            $new_password = $this->request->getVar('new_password');
            $cek = $this->model->get_user_password($id, $password);
            if (!$cek) {
                return $this->failNotFound('Wrong password');
            } else {
                $this->model->update_pswd($id, $new_password);
                $data = [
                    'status' => 200,
                    'messages' => 'Password has been changed'
                ];
                return $this->respond($data);
            }
        }
    }
}