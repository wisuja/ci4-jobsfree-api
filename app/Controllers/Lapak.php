<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Lapak extends ResourceController
{
    protected $modelName = 'App\Models\LapakModel'; //di panggil dengan $this->model
    protected $format = 'json';

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    //get data lapak secara keseluruhan
    //http://localhost:8080/lapak/
    //method: GET
    public function index()
    {
        $data = $this->model->getLapak();
        return $this->respond($data, 200);
    }

    //get lapak berdasarkan category
    //http://localhost:8080/lapak/category/$id
    //method: GET
    public function category($id)
    {
        $data = $this->model->getCategory($id);
        return $this->respond($data);
    }

    // get data lapak berdasarkan id lapak
    // http://localhost:8080/lapak/$id
    //method: GET
    public function show($id = null)
    {
        $data = $this->model->getLapak($id);
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    // input lapak
    //http://localhost/lapak
    //method : POST
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
                'created_on' => date("Y-m-d H:i:s"),
            ];
            $post_id = $this->model->insert($data);
            $data['id'] = $post_id;
            return $this->respondCreated($data);
        }
    }

    // edit lapak
    //http://localhost/lapak/$id
    // method : PUT

    public function update($id = null)
    {
        helper(['form']);

        $rules = [
            'category_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'requirement' => 'required',
            'price_tag' => 'required',
            'working_hours' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $input = $this->request->getRawInput();
            $data = [
                'id' => $id,
                'category_id' => $input['category_id'],
                'title' => $input['title'],
                'description' => $input['description'],
                'requirement' => $input['requirement'],
                'price_tag' => $input['price_tag'],
                'working_hours' => $input['working_hours'],
                'status' => $this->request->getVar('status'),
                'created_on' => date("Y-m-d H:i:s"),
            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }

    // hapus lapak
    //http://localhost/lapak/$id
    // method : DELETE
    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $data['message'] = "Deleted id = $id";
            $this->model->delete($id);
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }
}