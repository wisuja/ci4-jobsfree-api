<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Roles extends ResourceController
{
    protected $modelName = 'App\Models\RolesModel';
    protected $format = 'json';

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
        return $this->response->setHeader('Access-Control-Allow-Origin', '*')->setHeader('Access-Control-Allow-Headers', '*')->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE')->setStatusCode(200);
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