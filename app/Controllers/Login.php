<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
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

    public function create()
    {
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $val_email = $this->model->get_email($email);

            if ($val_email) {
                $user = $this->model->get_user_password($email, $password);
                if ($user) {
                    $data = [
                        "status" => 200,
                        'id' => $user['id'],
                        'email' => $user['email'],
                        'name' => $user['name'],
                        'role_id' => $user['role_id'],
                        'image' => $user['image'],
                        'phone_no' => $user['phone_no'],
                        'idcard_no' => $user['idcard_no'],
                    ];
                    return $this->respond($data, 200);
                } else {
                    return $this->failNotFound('Wrong password');
                }
            } else {
                return $this->failNotFound('Email not Found');
            }
        }
    }
}