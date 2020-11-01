<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Users extends ResourceController
{
    protected $modelName = 'App\Models\UsersModel';
    protected $format = 'json';
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }
}