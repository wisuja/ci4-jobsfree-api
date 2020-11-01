<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\RESTful\ResourceController;

class Login extends ResourceController
{
    protected $modelName = 'App\Models\UsersModel';
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
        $user = new UsersModel();

        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');

            $user = $user->get_user($email, $password);


            if ($user) {
                $data = [
                    "status" => 200,
                    'email' => $user['email'],
                ];
                return $this->respond($data, 200);
            } else {
                return $this->failNotFound('Item not Found');
            }
        }
    }
}