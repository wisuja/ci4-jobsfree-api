<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class Transaction extends ResourceController
{
    protected $modelName = 'App\Models\TransactionModel';
    protected $format = 'json';

    public function __construct()
    {
        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
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
            'lapak_id' => 'required',
            'freelancer_id' => 'required',
            'client_id' => 'required',
            'payment_via' => 'required',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'lapak_id' => $this->request->getVar('lapak_id'),
                'freelancer_id' => $this->request->getVar('freelancer_id'),
                'client_id' => $this->request->getVar('client_id'),
                'payment_date' => $this->request->getVar('payment_date'),
                'payment_via' => $this->request->getVar('payment_via'),
                'creates_on' => date("Y-m-d H:i:s"),
            ];
            $post_id = $this->model->insert($data);
            $data['id'] = $post_id;
            return $this->respondCreated($data);
        }
    }

    //get transaksi yang telah di setujui dan belum dikerjakan
    public function ongoing($id = null)
    {
        $data = $this->model->ongoing($id);

        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Item not Found');
        }
    }

    //konfirmasi pengerjaan untuk jasa. terima atau batal
    //method : PUT
    public function confirm($id = null)
    {
        helper(['form']);

        $rules = [
            'accept' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'id' => $id,
                'accept' => $this->request->getVar('accept'),
            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }

    //transaksi yang selesai
    //Method : PUT
    public function done($id = null)
    {
        helper(['form']);

        $rules = [
            'status' => 'required',
        ];
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        } else {
            $data = [
                'id' => $id,
                'status' => $this->request->getVar('status'),
            ];
            $this->model->save($data);
            return $this->respond($data);
        }
    }
}