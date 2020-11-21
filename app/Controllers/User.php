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

    // public function create()
    // {
    //     helper(['form']);

    //     $rules = [
    //         'role_id' => 'required',
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //         'image' => 'required',
    //         'phone_no' => 'required',
    //         'idcard_no' => 'required',
    //         'status' => 'required',

    //     ];

    //     if (!$this->validate($rules)) {
    //         return $this->fail($this->validator->getErrors());
    //     } else {
    //         $data = [
    //             'user_id' => $this->request->getVar('user_id'),
    //             'category_id' => $this->request->getVar('category_id'),
    //             'title' => $this->request->getVar('title'),
    //             'description' => $this->request->getVar('description'),
    //             'requirement' => $this->request->getVar('requirement'),
    //             'price_tag' => $this->request->getVar('price_tag'),
    //             'working_hours' => $this->request->getVar('working_hours'),
    //             'status' => $this->request->getVar('status'),

    //         ];
    //         $post_id = $this->model->insert($data);
    //         $data['id'] = $post_id;
    //         return $this->respondCreated($data);
    //     }
    // }
}