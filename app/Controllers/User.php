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
    //http://localhost/$id
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
}