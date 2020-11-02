<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Category extends ResourceController
{
    protected $modelName = 'App\Models\CategoryModel';
    protected $format = 'json';
    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    //get data seluruh category jasa
    //http://localhost:8080/category
    //method : GET
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    //get data per ID category
    //http://localhost:8080/category/$id
    //method:GET
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