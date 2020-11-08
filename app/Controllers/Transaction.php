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

    public function create()
    {
        helper(['form']);

        $rules = [
            'lapak_id' => 'required',
            'freelancer_id' => 'required',
            'client_id' => 'required',
            'payment_date' => 'required',
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
            ];
            $post_id = $this->model->insert($data);
            $data['id'] = $post_id;
            return $this->respondCreated($data);
        }
    }
}