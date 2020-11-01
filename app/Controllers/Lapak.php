<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Lapak extends ResourceController
{
    protected $modelName = 'App\Models\LapakModel';
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

    public function create()
    {
        helper(['form']);

        $rules = [
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'requirement' => 'required',
            'price_tag' => 'required',
            'working_hours' => 'required',
            'status' => 'required',
            'creates_on' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'user_id' => $this->request->getVar('user_id'),
                'category_id' => $this->request->getVar('category_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'requirement' => $this->request->getVar('requirement'),
                'price_tag' => $this->request->getVar('price_tag'),
                'working_hours' => $this->request->getVar('working_hours'),
                'status' => $this->request->getVar('status'),
                'creates_on' => $this->request->getVar('creates_on'),
            ];
            $post_id = $this->model->insert($data);
            $data['post_id'] = $post_id;
            return $this->respondCreated($data);
        }
    }

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'user_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'user_id' => $this->request->getVar('user_id'),
                'category_id' => $this->request->getVar('category_id'),
                'title' => $this->request->getVar('title'),
                'description' => $this->request->getVar('description'),
                'requirement' => $this->request->getVar('requirement'),
                'price_tag' => $this->request->getVar('price_tag'),
                'working_hours' => $this->request->getVar('working_hours'),
                'status' => $this->request->getVar('status'),
                'creates_on' => $this->request->getVar('creates_on'),
            ];

            $this->model->save($data);
            return $this->respond($data);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->find($id);
        $data['message'] = "Deleted id = $id";
        if ($data) {
            $this->model->delete($id);
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }
}